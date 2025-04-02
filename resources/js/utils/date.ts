// types/date.ts or utils/date.ts (choose appropriate location)

// Constants
const MONTH_NAMES = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];

  const MONTH_NAMES_SHORT = [
    "Jan", "Feb", "Mar", "Apr", "May", "Jun",
    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
  ];

  const DAY_NAMES = [
    "Sunday", "Monday", "Tuesday", "Wednesday",
    "Thursday", "Friday", "Saturday"
  ];

  const DAY_NAMES_SHORT = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

  // Core Formatters
  export const formatDate = (date: Date | string = new Date()): string => {
    const d = new Date(date);
    return `${d.getDate()} ${MONTH_NAMES[d.getMonth()]}, ${d.getFullYear()}`;
  };

  export const formatDateTime = (date: Date | string = new Date()): string => {
    return `${formatDate(date)} at ${formatTime(date)}`;
  };

  export const formatTime = (date: Date | string = new Date()): string => {
    const d = new Date(date);
    return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
  };

  // Date Components
  export const getDayOfMonth = (date: Date | string = new Date()): number => {
    return new Date(date).getDate();
  };

  export const getDayOfMonthWithSuffix = (date: Date | string = new Date()): string => {
    const day = new Date(date).getDate();
    const suffix = day % 10 === 1 && day !== 11 ? 'st' :
                   day % 10 === 2 && day !== 12 ? 'nd' :
                   day % 10 === 3 && day !== 13 ? 'rd' : 'th';
    return `${day}${suffix}`;
  };

  export const getMonthName = (date: Date | string = new Date()): string => {
    return MONTH_NAMES[new Date(date).getMonth()];
  };

  export const getMonthNameShort = (date: Date | string = new Date()): string => {
    return MONTH_NAMES_SHORT[new Date(date).getMonth()];
  };

  export const getYear = (date: Date | string = new Date()): number => {
    return new Date(date).getFullYear();
  };

  export const getDayOfWeek = (date: Date | string = new Date()): string => {
    return DAY_NAMES[new Date(date).getDay()];
  };

  export const getDayOfWeekShort = (date: Date | string = new Date()): string => {
    return DAY_NAMES_SHORT[new Date(date).getDay()];
  };

  // Time Components
  export const getTime12Hour = (dateString: string, timezone?: string): string => {
    if (!dateString) return '--:--';

    try {
        const date = new Date(dateString);

        // Convert to specified timezone (or use local time if not specified)
        const options: Intl.DateTimeFormatOptions = {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        };

        if (timezone) {
            options.timeZone = timezone;
        }

        let formattedTime = date.toLocaleTimeString([], options);

        // Remove leading zero if present (some browsers still add it with numeric)
        formattedTime = formattedTime.replace(/^0/, '');

        return formattedTime;
    } catch (e) {
        console.error('Error formatting time:', e);
        return '--:--';
    }
};

  export const getTime24Hour = (date: Date | string = new Date()): string => {
    const d = new Date(date);
    return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false });
  };

  export const getTimeWithSeconds = (date: Date | string = new Date()): string => {
    const d = new Date(date);
    return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
  };

  // Date Formats
  export const formatDateNumeric = (date: Date | string = new Date()): string => {
    const d = new Date(date);
    return [d.getDate(), d.getMonth() + 1, d.getFullYear()]
      .map(n => n.toString().padStart(2, '0'))
      .join('/');
  };

  export const formatDateShort = (date: Date | string = new Date()): string => {
    const d = new Date(date);
    return [d.getDate(), d.getMonth() + 1, d.getFullYear().toString().slice(-2)]
      .map(n => n.toString().padStart(2, '0'))
      .join('/');
  };

  export const formatDateMonthYear = (date: Date | string = new Date()): string => {
    const d = new Date(date);
    return `${d.getDate()} ${MONTH_NAMES_SHORT[d.getMonth()]} ${d.getFullYear()}`;
  };

  // Relative Time
  export const timeAgo = (date: Date | string = new Date()): string => {
    const now = new Date();
    const d = new Date(date);
    const seconds = Math.round((now.getTime() - d.getTime()) / 1000);
    const minutes = Math.round(seconds / 60);
    const hours = Math.round(minutes / 60);
    const days = Math.round(hours / 24);

    if (seconds < 60) return `${seconds} seconds ago`;
    if (minutes < 60) return `${minutes} minutes ago`;
    if (hours < 24) return `${hours} hours ago`;
    if (days === 1) return 'yesterday';
    if (days < 7) return `${days} days ago`;
    if (days < 30) return `${Math.round(days / 7)} weeks ago`;
    if (days < 365) return `${Math.round(days / 30)} months ago`;
    return `${Math.round(days / 365)} years ago`;
  };

  // Helpers
  export const isToday = (date: Date | string): boolean => {
    const today = new Date();
    const d = new Date(date);
    return d.getDate() === today.getDate() &&
           d.getMonth() === today.getMonth() &&
           d.getFullYear() === today.getFullYear();
  };

  export const isYesterday = (date: Date | string): boolean => {
    const yesterday = new Date();
    yesterday.setDate(yesterday.getDate() - 1);
    const d = new Date(date);
    return d.getDate() === yesterday.getDate() &&
           d.getMonth() === yesterday.getMonth() &&
           d.getFullYear() === yesterday.getFullYear();
  };

  // Duration Formatting (Bonus)
  export const formatDuration = (milliseconds: number): string => {
    const seconds = Math.floor(milliseconds / 1000);
    const minutes = Math.floor(seconds / 60);
    const hours = Math.floor(minutes / 60);

    return [
      hours.toString().padStart(2, '0'),
      (minutes % 60).toString().padStart(2, '0'),
      (seconds % 60).toString().padStart(2, '0')
    ].join(':');
  };
