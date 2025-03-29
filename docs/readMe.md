
1. forums 
    1. roles
        1. guests
        2. users
        3. moderators
        4. admin
    2. search by
        1. posts
        2. comments
        3. categories
    3. lists
        1. category
        2. posts
        3. comments
    4. create
        1. posts
        2. comments
    5. login
        1. make sure that i create some sort of switch case which redirects the usr to the right page after logging in
            1. if on create post, after logging in takes them to the create post page
            2. if on a post and wants to comment, after logging in takes them to that post
            3. etc.. dashboard page, 

2. resort info
    1. mountain info
        1. run types
        2. acerage
        3. day ticket price
        4. number of chairlifts/gondolas
        5. weather forecast
    2. travel
        1. around town
        2. to city
        3. to country
    3. food
        1. grocery stores
        2. restaurants
        3. mountain food

3. marketplace 
    1. buy gear
        1. auction
        2. buy price
    2. sell gear


# tests - manual

1. posts
    1. create
    2. update
    3. delete
    4. show
2. comments
    1. show
    2. create
    3. update
    4. delete    
3. lists
    1. show posts
    2. show categories
    3. show user posts
    4. show user comments


- redo database
- continents
- countries
- resorts

- resorts need to hvae a few different things
    - forum posts based by topic
    - resort api data
        - weather
        - wikipedia
        - youtube
        - instagram
        - 


# v2

- whats next? 

    - i should try make a plan of what to fix first and in what order 
    - i should also try write out all of the features i eventually want to add so i can come up with some useful structure for 
    - get the websockets working? or at least events for component updates

 ## pages

 - potentially create a trip planner, have its own page and also a resort category

 ### resort home
    - add in a better info bar that can expand in size to show a bit more then has a more button to go to the info page
    - add in reviews section
    - cheapest / most expensive restaurant 
    - cheapest / most expensive hotel
    - snowfall by month
    - most expensive time of year
    - cheapest time of year
    - slideshow for heroImage
    - link to resort map

### info
    - show different mountains
    - show stores in mountain if they exist and restaurants for on mountain food
    - ticket prices 
    - if there are events show them 
    - some weather info, link to weather page

### hotels
    - select a date
    - price per trip filter
    - map location 
    - sort by hotels api, airbnb api, local businesses, chalets, students

### restaurants
    - can book a time
    - filter: price, location
    - show on map
    - open now
    - delivery
    - grovery stores
    - cafe's
    - late night snack
    - potentially implement a roster system? and also pay system with zero?

### forums - resortPage
    - update the controller's / models /migration / routes / pages / components / - probably best to start again
    - import the data for the info bar, and the heroImage - resort Image
    - fix UI for scrolling
    - add in add's

### bars 
    - apres
    - sports
    - bars
    - clubs
    - sort by price
    - close late
    - with food
    - location
    - on mountain 

### events
    - by location
    - local vs business
    - price
    - nearest city
    - sports (local ice hockey), ski events, club events
    - should be able to buy tickets, figure out some sort of auth system for when the user shows up
    - create event: time, length, ticket price, category, description
    - get support?

### jobs
    - by location
    - category: for the mountain, finance, construction, clothes, etc.., ski store
    - filter: per hourly rate, latest
    - create: must have business account first, create: duration, job title, company, day to day, interactions: manager, baartenders or just tim , benefits, pay, contact

### marketplace
    - by location
    - category
    - can probably be the same as the general marketplace except the otherone is worldwide but you can only sort by look at shit within the resort area? 
    - implement a shopping cart
    - implement payment system: bitcoin, monero, stripe, paypal, credit card, 

### business
    - description
    - category: physio's, rental, clothes, pharmacy, bank, post office etc..
    - sort by location, show on map with different icons
    - can create employee's - username and password
    - can add booking slot for business
    - can post jobs
    - can create business: 

### weather
    - should be veryyyy detailed
    - show card per mountain if multiple per resort for same data set
    - current weather
    - next 24 hours
    - next 48 hours
    - next 72 hours
    - next 5 days
    - next week
    - big events potentially coming
    - eventaully get AI to study it to predict better patterns
    - be able to select weather based on api

### reviews
    - resort reviews

### youtube content
    - influencer cunts

## resorts
    - should be quite good after that

## forums
    - be able to do a global search for different categories
    - can add vidoes/photos to posts
    - can rate posts
    - add more info about posts to homepage
    - redo homepage to add more info 

## marketplace
    - worldwide search 
    - encrypt items
    - create auction
    - encrypt seller 

## casino
    - implement games where the house wins

## chat
    - encrypted
    - videos/images
    - calls as well eventually
    - chat modal

## notifications
    - modify the guest bottom left icon
    - create a notification system? for weather as well? and products wishlist prices 
    - emails in app, text? 
    - notification modal

## admin
    - guest tracking
    - user tracking

## shops
    - marketing
    - products on store
    - invoices etc..

## jobs
    - geolocation so jobs only show up for people in those locations or add a modal 'sorry it seems like you are located outside the area the job is advertising for: view anyway'

## once everything is done
    - get UI done for mobile / desktop
    - backend testing
    - move to AWS
    - progressive web app
    - location tracking with ski runs

## random potential features
    - if you buy ski pass through this you get access to all these features?
    - parent can add money to a ski pass, so the kids can buy lunch or somethign?




# models / tables

### user's
- has post
- has comment
- has marketplace listing
- has chat
- has resumse?
- has ski_account

### post
- belongsTo user
- hasmany comments
- has category

### comments
- belongsTo Post
- hasMany users?

## listing
- location, user, rating, category, 
- belongTo user or business
- hasMany ratings (can only leave a rating if purchased)
- hasMany reviews
- can message owner
- can be auction

## restaurant
- menu, hours, delivery, pickup, bookings, maxSeating, minimum spend, average price, location, photos, reviews
- belongsTo business
- hasMany bookings
- hasMany seats available?

## cart
- has items
- has payment
- has invoice?

## invoice
- has user
- has business
- has items

## casino
- has encryption
- has winnings
- has losses
- has games
- has maths 
- has privacy warning

## companies
- belongs to User
- hasMany employee's
- can create employee
- can create marketplace listings
- can creaste events
- can post forums
- can reply to reviews
- can have bookings
- can accept payments?

## employee's
- belngsTo company
- has wage

## chat
- has encprytion
- has user
- has sender
- has receiver
- has message

## mesage
- has time
- has files
- has title (potentially)
- has content


# v3

### what do i start with first? 

- epxand the info bar size when pressed
- basic weather api
- add weather to infobar component
- re do the forums
- create role middleware: guest, user, business, admin
- create business
- admin user panel
- businesses: 
    - create forums (forums should be fixed so this should be possible),
    - create job openings
    - create business page
    - add location api


# end result
- admin can create resort, complete tracking system, 
- business can create purchase ad(marketing), post forums, post job ads post on marketplace - free up to 10 items? (30, 50, 100) 
- users can post on marketplace, create forums, apply jobs,
- anyone can message anyone? groups eventually
- mobile app for ski run tracking, find my friends on the hill, drop pin meetup location with time (get alarm for when you have to get over, taking into acount chairlift lines and runs)
