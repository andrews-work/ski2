<?php

namespace App\Http\Controllers;

use App\Models\Resort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ResortInfoController extends Controller
{
    public function getInfoboxData($resortName)
    {
        try {
            $resort = Resort::where('name', $resortName)->first();

            if (!$resort) {
                Log::error('Resort not found in the database:', ['resortName' => $resortName]);
                return ['error' => 'Resort not found in the database.'];
            }

            $wikiUrl = $resort->wiki_url;

            if (!$wikiUrl) {
                Log::error('Wikipedia URL not found for resort:', ['resortName' => $resortName]);
                return ['error' => 'Wikipedia URL not found for resort.'];
            }

            Log::info('Fetching Wikipedia page:', ['resortName' => $resortName, 'wikiUrl' => $wikiUrl]);

            $response = Http::get("https://en.wikipedia.org/api/rest_v1/page/html/{$wikiUrl}");

            if ($response->successful()) {
                $html = $response->body();

                $infobox = $this->extractInfobox($html);

                if ($infobox) {
                    $infoboxData = $this->parseInfoboxData($infobox);

                    // Save relevant data to the database
                    if (isset($infoboxData['Coordinates'])) {
                        $coordinates = $this->parseCoordinates($infoboxData['Coordinates']);
                        if ($coordinates) {
                            // Only update if the current value is null
                            if (is_null($resort->latitude)) {
                                $resort->latitude = $coordinates['latitude'];
                            }
                            if (is_null($resort->longitude)) {
                                $resort->longitude = $coordinates['longitude'];
                            }
                        }
                    }

                    if (isset($infoboxData['Base elevation'])) {
                        $baseElevation = $this->parseElevation($infoboxData['Base elevation'], 'base');
                        Log::info('Parsed base elevation:', ['baseElevation' => $baseElevation]);

                        if (!is_null($baseElevation)) {
                            Log::info('Current base_elevation in database:', ['current_base_elevation' => $resort->base_elevation]);
                            $resort->base_elevation = $baseElevation;
                            Log::info('Updating base_elevation:', ['new_base_elevation' => $baseElevation]);

                            // Custom log for base elevation
                            Log::info('Custom Base Elevation Log After Update:', [
                                'base_elevation' => $baseElevation,
                                'resortName' => $resortName,
                            ]);
                        } else {
                            Log::warning('Failed to parse base elevation:', ['raw_value' => $infoboxData['Base elevation']]);
                        }
                    }

                    if (isset($infoboxData['Top elevation'])) {
                        $peakElevation = $this->parseElevation($infoboxData['Top elevation'], 'peak');
                        Log::info('Parsed peak elevation:', ['peakElevation' => $peakElevation]);

                        if (!is_null($peakElevation)) {
                            Log::info('Current peak_elevation in database:', ['current_peak_elevation' => $resort->peak_elevation]);
                            $resort->peak_elevation = $peakElevation;
                            Log::info('Updating peak_elevation:', ['new_peak_elevation' => $peakElevation]);
                        } else {
                            Log::warning('Failed to parse peak elevation:', ['raw_value' => $infoboxData['Top elevation']]);
                        }
                    }

                    // Log the state of the resort model before saving
                    Log::info('Resort model before saving:', [
                        'base_elevation' => $resort->base_elevation,
                        'peak_elevation' => $resort->peak_elevation,
                    ]);

                    $saveResult = $resort->save();
                    Log::info('Resort data save result:', ['saveResult' => $saveResult]);

                    // Log the state of the resort model after saving
                    Log::info('Resort model after saving:', [
                        'base_elevation' => $resort->base_elevation,
                        'peak_elevation' => $resort->peak_elevation,
                    ]);

                    // Save additional fields
                    if (isset($infoboxData['Nearest major city'])) {
                        $nearestCity = $this->cleanNearestCity($infoboxData['Nearest major city'], $resortName);
                        $resort->nearest_city = $nearestCity;
                        Log::info('Updating nearest_city:', ['nearest_city' => $nearestCity]);
                    }

                    if (isset($infoboxData['Website'])) {
                        $resort->website = $infoboxData['Website'];
                        Log::info('Updating website:', ['website' => $infoboxData['Website']]);
                    }

                    if (isset($infoboxData['Skiable area'])) {
                        $resort->skiable_area = $infoboxData['Skiable area'];
                        Log::info('Updating skiable_area:', ['skiable_area' => $infoboxData['Skiable area']]);
                    }

                    if (isset($infoboxData['Lift system'])) {
                        $resort->lifts = $infoboxData['Lift system'];
                        Log::info('Updating lifts:', ['lifts' => $infoboxData['Lift system']]);
                    }

                    if (isset($infoboxData['Vertical'])) {
                        $resort->vertical = $infoboxData['Vertical'];
                        Log::info('Updating vertical:', ['vertical' => $infoboxData['Vertical']]);
                    }

                    $saveResult = $resort->save();
                    Log::info('Resort data save result:', ['saveResult' => $saveResult]);

                    Log::info('Resort data saved to database:', [
                        'resortName' => $resortName,
                        'latitude' => $resort->latitude,
                        'longitude' => $resort->longitude,
                        'base_elevation' => $resort->base_elevation,
                        'peak_elevation' => $resort->peak_elevation,
                        'nearest_city' => $resort->nearest_city,
                        'website' => $resort->website,
                        'skiable_area' => $resort->skiable_area,
                        'lifts' => $resort->lifts,
                        'vertical' => $resort->vertical,
                    ]);

                    $formattedData = $this->formatArrayForLogging($infoboxData);
                    Log::info("Wikipedia Infobox Data:\n$formattedData");

                    return $infoboxData;
                } else {
                    Log::error('Infobox not found in the HTML. First 1000 characters:', [
                        'html' => substr($html, 0, 1000),
                    ]);
                    return ['error' => 'Infobox not found in the HTML.'];
                }
            } else {
                Log::error('Failed to fetch data from Wikipedia API', [
                    'resortName' => $resortName,
                    'wikiUrl' => $wikiUrl,
                    'status' => $response->status(),
                ]);
                return ['error' => 'Failed to fetch data from Wikipedia API'];
            }
        } catch (\Exception $e) {
            Log::error('Exception occurred while fetching data:', [
                'resortName' => $resortName,
                'error' => $e->getMessage(),
            ]);
            return ['error' => $e->getMessage()];
        }
    }

    private function cleanNearestCity($nearestCity, $resortName): string
    {
        $nearestCity = trim($nearestCity);
        $resortName = trim($resortName);

        if (strpos($nearestCity, $resortName) === 0) {
            $nearestCity = trim(substr($nearestCity, strlen($resortName)));
        }

        return $nearestCity;
    }

    private function parseCoordinates($coordinates): ?array
    {
        $pattern = '/(\d+\.\d+);\s*(-?\d+\.\d+)/';
        preg_match($pattern, $coordinates, $matches);

        if (isset($matches[1]) && isset($matches[2])) {
            return [
                'latitude' => (float) $matches[1],
                'longitude' => (float) $matches[2],
            ];
        }

        return null;
    }

    private function parseElevation($elevation, $type = 'base'): ?int
    {
        Log::info("Raw {$type} elevation value:", ['raw_value' => $elevation, 'type' => $type]);

        // Remove commas and special spaces from the elevation string for easier parsing
        $elevation = str_replace([',', ' '], '', $elevation);
        Log::info("Cleaned {$type} elevation value:", ['cleaned_value' => $elevation]);

        // Pattern to match all occurrences of "location: value" (e.g., "Creekside: 653 m")
        $pattern = '/(?:[\w\s]+:\s*(\d+)\s*(?:m|ft))/';
        preg_match_all($pattern, $elevation, $matches);

        Log::info("Regex matches for {$type} elevations:", ['matches' => $matches]);

        if (!empty($matches[1])) {
            // Extract the elevations and convert them to integers
            $elevations = array_map('intval', $matches[1]);
            Log::info("Parsed {$type} elevations:", ['elevations' => $elevations]);

            // Determine the base elevation or peak elevation based on type
            if ($type === 'base') {
                $result = min($elevations); // Selecting minimum for base elevation
                Log::info("Selected base elevation:", ['base_elevation' => $result]);
            } else {
                $result = max($elevations); // Selecting maximum for peak elevation
                Log::info("Selected peak elevation:", ['peak_elevation' => $result]);
            }

            return $result;
        }

        Log::warning("No {$type} elevation values found in raw input:", ['raw_value' => $elevation]);
        return null;
    }

    private function extractInfobox($html)
    {
        $pattern = '/<table[^>]*class="[^"]*\binfobox\b[^"]*"[^>]*>.*?<\/table>/is';
        preg_match($pattern, $html, $matches);

        if (empty($matches)) {
            $pattern = '/<table[^>]*class="[^"]*\bvcard\b[^"]*"[^>]*>.*?<\/table>/is';
            preg_match($pattern, $html, $matches);
        }

        return $matches[0] ?? null;
    }

    private function parseInfoboxData($infoboxHtml)
    {
        $infoboxHtml = mb_convert_encoding($infoboxHtml, 'HTML-ENTITIES', 'UTF-8');

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($infoboxHtml);
        libxml_clear_errors();
        $data = [];
        $rows = $dom->getElementsByTagName('tr');

        foreach ($rows as $row) {
            $label = $row->getElementsByTagName('th')->item(0);
            $value = $row->getElementsByTagName('td')->item(0);

            if ($label && $value) {
                $labelText = trim($label->textContent);
                $valueText = trim($value->textContent);

                if (!empty($labelText)) {
                    $data[$labelText] = $valueText;
                }
            }
        }

        return $data;
    }

    private function formatArrayForLogging(array $data): string
    {
        $formattedString = "[\n";
        foreach ($data as $key => $value) {
            $formattedString .= "    \"$key\" => \"$value\",\n";
        }
        $formattedString .= "]";
        return $formattedString;
    }
}
