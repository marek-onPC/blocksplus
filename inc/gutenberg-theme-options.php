<?php
/**
 * Define Gutenberg's Color Palette set of colors
 */
function gutenbergPlusColorPaletteSet() {
  $colorPaletteOptionOn = get_option('gutenberg_plus_color_palette_enable');
  $colorPaletteOptions = get_option('gutenberg_plus_color_palette');

  if ($colorPaletteOptionOn == 'false') {
    return;
  } else {
    if (empty($colorPaletteOptions)) {
      return;
    } else {
      $colorPaletteArray = array();

      foreach ($colorPaletteOptions as $paletteElement) {
        array_push($colorPaletteArray, array(
          'name' => $paletteElement->colorName,
          'slug' => sanitize_title($paletteElement->colorName),
          'color' => $paletteElement->colorValue
        ));
      }
    }
  }

  add_theme_support(
    'editor-color-palette',
    $colorPaletteArray
  );
};
add_action('init', 'gutenbergPlusColorPaletteSet');

/**
 * Define Gutenberg's Font Sizes set of fonts
 */
function gutenbergPlusFontSizesSet() {
  $fontSizesOptionOn = get_option('gutenberg_plus_font_sizes_enable');
  $fontSizesOptions = get_option('gutenberg_plus_font_sizes');

  if ($fontSizesOptionOn == 'false') {
    return;
  } else {
    if (empty($fontSizesOptions)) {
      return;
    } else {
      $fontSizesArray = array();

      foreach ($fontSizesOptions as $fontElement) {
        array_push($fontSizesArray, array(
          'name' => $fontElement->fontName,
          'slug' => sanitize_title($fontElement->fontName),
          'size' => (int)$fontElement->fontSize
        ));
      }
    }
  }

  add_theme_support(
    'editor-font-sizes',
    $fontSizesArray
  );
};
add_action('init', 'gutenbergPlusFontSizesSet');

/**
 * Create and load Gutenberg's Color Palette and Font Sizes styles in <head> tag
 */
function gutenbergPlusFrontEndStyles() {
  $colorPaletteOptionOn = get_option('gutenberg_plus_color_palette_enable');
  $colorPaletteOptions = get_option('gutenberg_plus_color_palette');
  $fontSizesOptionOn = get_option('gutenberg_plus_font_sizes_enable');
  $fontSizesOptions = get_option('gutenberg_plus_font_sizes');


  if ($colorPaletteOptionOn != 'false') {
    if (!empty($colorPaletteOptions)) {
      echo '<style type="text/css" id="gutenberg-plus-color-palette">';
      foreach ($colorPaletteOptions as $paletteElement) {
        echo '
        .has-text-color.has-'.sanitize_title($paletteElement->colorName).'-color { color: '.$paletteElement->colorValue.';}
        .has-background.has-'.sanitize_title($paletteElement->colorName).'-background-color { background-color: '.$paletteElement->colorValue.';}
        ';
      }
      echo '</style>';
    }
  }
  
  if ($fontSizesOptionOn != 'false') {
    if (!empty($fontSizesOptions)) {
      echo '<style type="text/css" id="gutenberg-plus-font-sizes">';
      foreach ($fontSizesOptions as $fontElement) {
        echo '
        .has-'.sanitize_title($fontElement->fontName).'-font-size { font-size: '.(int)$fontElement->fontSize.'px;}
        ';
      }
      echo '</style>';
    }
  }
};
add_action('wp_head', 'gutenbergPlusFrontEndStyles');