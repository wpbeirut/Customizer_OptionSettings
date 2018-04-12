# Customizer_OptionSettings
Best Practice to decide when to use theme options page (simple or complex) or Customizer API

you can find the customizer demo folder include the following theme.

# wp-beirut-customizer

  ### Objectives
  1. have a boilerplate or awarness on how to use the customizer api in wordpress.
  2. you can copy the theme on your theme folder of wordpress and activate it.
  3. click customize and you can see the customizer on the left.


  ### Development process methodology and concept
  1. Define a Section
  2. Adding a Setting
  3. Add a Control
  4. Write the Javascript
  5. Make the call to `get_theme_mod`

you can find the theme option demo folder include the followign theme.

# wp-beirut-options

	### Objectives
	1. have a boilerplate or awarness on how to use the theme options (settings api) in wordpress.
	2. you can copy the theme on your theme folder of wordpress and activate it.
	3. go to appearance -> Theme Options to view the theme settings developed for this demo.
	4. the preview of the demo is a bulk of array to make you understand how to retrive settings values from the settings api.

	### Development process methodology and concept
	1. Adding the Administration Menu
	2. Creating a Settings Section and Field
	3. Displaying the Fields
	4. Sanitizing Data
	5. Creating Section and Field Definitions
	6. Displaying the Fields
	7. Initializing Options and Creating the Admin Menu
	8. Registering Settings and Displaying Fields and Sections
	9. Creating Working Image Upload Fields
	10. Adding Proper Field Sanitization

## Theme Options Page vs. WordPress Customizer
the WordPress customizer is probably the easiest option for customizing the front-end. The main reason is that it’s built in; you don’t need to install additional plugins to use it. Additionally, it has a great live preview on the side that makes customizing really intuitive.

A theme options page, on the other hand, is custom, which means you need to need to hard code it in the theme files or use it as a separate plugin.
