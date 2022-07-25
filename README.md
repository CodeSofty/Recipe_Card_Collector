# Recipe Card Collector 
A CRUD app for users to upload their own recipes and images, with its own API to control CRUD functions.

## Why Did You Build This?

- To give myself and my family a place to store family recipes online, rather than note cards.
- To give users access to family recipes no matter where they are, in an easy-to-access way.
- To get better at CRUD apps, the challenge of learn more about AWS, and Heroku.

## What Tools Did You Use To Build This?

- PHP
- MySQL
- An AWS S3 Bucket (for image storage)
- Bootstrap

## What Did You Learn?

Honestly, I learned a lot more than I expected. After completing this app I feel much more comfortable sinking into documentation and problem solving
when a soluton isn't really available. I relied on Documentation, Stack Overlow, Youtube, Discord, and my own knowledge the entire way.

- I learned how to find current documentation, Amazon's documentation didn't always work the way it claimed,
so I turned to Stack Overflow and Youtube, but most of the information out there was using older versions than what I was. This
forced me to take my time, piecing together what information I needed to make my app function correctly.

- I had to learn how to troubleshoot PHP a lot, this included the MVC file structure, AWS API calls, and my own API calls with Postman that had to work
together to make the app function the way I envisioned.

- Once completed, my app functioned well locally, but it didn't once uploaded to Heroku because of Heroku's ephemeral filesystem. My file structure also had 
to be rearranged a little bit to accomodate Heroku's filesystem as well.

- Handling renaming files, finding a solution to gather previous file names and changing them to a new name when updating an image, and 
uploading to AWS.

- Troubleshooting file size limits caused Recipes to not upload correctly.


## Tell Me About What I Should Expect When First Loading The App...
When first loading the app, the User is greeted by a screen with no cards on it. The User can click on the "+" symbol at the bottom of the screen and upload an image, enter some recipe information, and save it to the app.

## Where Does The Data Go?
- The form fields will be uploaded to the connected database, using POST data and MySQL queries. 
- The CRUD functionality is also ran by MySQL queries. 
- The images will first be moved a local images folder for processing, and then uploaded to an AWS S3 bucket using the AWS SDK API.
- There is also an API that I built to connect with the CRUD functionality outside of the app



# ---- App Walkthrough ---- 
When first loading the app, the User is greeted by a screen with nothing showing. 
This is the screen where recipe cards will appear after uploading them with images attached.

### Recipe Card Page

There are three symbol at the bottom.

- The first is the "^" symbol, and is to reach the top of the page quickly.
- The second symbol is the "+" symbol and is to reach the upload screen, to add a new recipe.
- The third symbol is a windows symbol and is to reach the recipe card screen (the first screen that appears)
- Each Recipe Card has a button to view that card's recipe on a separate page.
- Each Recipe card has a "3 dot" symbol that, when clicked, will display a pencil (for updating the recipe information and image) and a trash can symbol (for deleting a recipe from the database).

### View Single Recipe Page

After clicking "View Recipe" on any of the cards, this view is displayed.
This page display a single recipe's information

### Tell Me About The REST API...

- The REST API gives access to the CRUD functionaity of the Recipe Card Collector.
- The API calls are ran by the same class as the MySQL queries that the rest of the app uses

### CRUD Functionality
- Users can CREATE by uploading data/images to the app.
- Users can READ when a recipe is displayed on the screen on either the Recipe Card page, or Recipe page.
- Users can UPDATE when a recipe is updated by clicking on the 3 dots on a recipe card, and then clicking on the pencil symbol, which brings up the form and image data to update.
- Users can DELETE when a recipe is deleted by clicking on the 3 dots on a recipe card, and then clicking on the trash can symbol, which removes the data from the database, and image in the AWS S3 Bucket.

##  Room For Improvement:

- One known features of AWS is that it will override a file if the same name is used.
- To avoid this, a unique ID is created in a hidden input field using timestamps when a user uploads a file.
- When a user updates a recipe's image, it's replaced with the new file, but the previous one is still left in the S3 bucket.
- This means that CRUD functionality still works in the app, but the S3 bucket will still hold onto the previous images instead of deleting them 
at the time of updating.
- Currently there is a file upload limit, which will not upload any files largers than 1MB, I am working on improving this.

### As of 7/25/22 this app is finished, besides minor adjustments that may be made.

