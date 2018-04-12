# Adding the Administration Menu
The very first thing we need to do is create a menu entry that will link to our theme options page.

# Creating a Settings Section and Field
WordPress has something called the “Settings API”. This allows us to create settings, store them in the database, create sections for grouping those settings, and create fields for displaying them.

# Displaying the Fields
Displaying the fields is pretty straightforward; we have to write the callback function we set in add_settings_field

# Sanitizing Data
Sanitizing data is something you must always do when dealing with user input, for security reasons. Someone might input harmful PHP code that, when saved to the database, can do serious damage. They might also inject JavaScript code that can create big problems when rendered on the front-end.

# Creating Section and Field Definitions
In the previous page, we defined our sections and fields in the initialization function. This approach is fine for just a few fields, but when we’re dealing with multiple fields and sections, we need to find a better, more elegant and efficient solution.

# Displaying the Fields
Displaying the fields is pretty straightforward; we have to write the callback function we set in add_settings_field.

# Initializing Options and Creating the Admin Menu
Let’s start by initializing our options. We do that because our page depends on querying the database for a record, so we need to make sure that record exists, even if it’s the first time we’re opening the theme options page.

# Registering Settings and Displaying Fields and Sections
Registering our settings and displaying fields is a bit more complicated in this version of the page. As we’re trying to make it as efficient as possible by introducing those two arrays, we need to run some loops that will repeatedly register settings and display fields.

# Creating Working Image Upload Fields
When dealing with image upload fields, we have two options. The first one is to use an input with the type file and write all the upload-related PHP ourselves.
Alternatively, we could use the new fancy image uploader from WordPress that allows us not only to upload an image, but also to select one from the media library.

# Adding Proper Field Sanitization
Let’s complete our theme options page by writing the sanitize function; this is where the sanitize field from our arrays will come in handy. We’re going to use it to determine what kind of sanitization is required for that particular field.