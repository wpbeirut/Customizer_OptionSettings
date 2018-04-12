# Customizer_OptionSettings
Best Practice to decide when to use theme options page (simple or complex) or Customizer API

you can find the customizer demo folder include the following theme.

  1 .wp-beirut customizer

  ### objectives
  1. have a boilerplate or awarness on how to use the customizer api in wordpress.
  2. you can copy the theme on your theme folder of wordpress and activate it.
  3. click customize and you can see the customizer on the left.


  ### Development process methodology and concept
  1. Define a Section
  2. Adding a Setting
  3. Add a Control
  4. Write the Javascript
  5. Make the call to `get_theme_mod`

## Theme Options Page vs. WordPress Customizer
the WordPress customizer is probably the easiest option for customizing the front-end. The main reason is that it’s built in; you don’t need to install additional plugins to use it. Additionally, it has a great live preview on the side that makes customizing really intuitive.

A theme options page, on the other hand, is custom, which means you need to need to hard code it in the theme files or use it as a separate plugin.
