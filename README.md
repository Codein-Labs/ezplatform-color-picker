# Codein eZColorPicker

Symfony bundle that adds color management to eZ Platform.

## Installation

```
composer require codein/ez-color-picker:dev-develop
```

Activate the bundle in AppKernel.php

```
new Codein\eZColorPicker\eZColorPickerBundle()
```

Compile the assets for the admin UI

```
./bin/console ezplatform:encore:compile
```

## Usage

### Default value

You can set a default color for your field. The default color will be proposed to the user if no color is already set.
If the field is required, the default color is assigned as default. If not, no color is assigned.

### Twig

The default color format rendered in Twig is RGBa. You can pass extra options to ez_render_field.

* format:  RGBa, HEXa, HSVa, RGB, HEX
* default:  default value returned if field is empty. If not set ez_render_field will return an empty string

```twig
{{ ez_render_field(content, 'color2', {'parameters': {'format': 'HEX', 'default': 'none'}}) }}
```

### Migration

The method \Codein\eZColorPicker\FieldType\ColorPicker\Type::acceptValue will accept a single string and convert it into 
a color. Following formats are converted into a valid value object : 

```
HSVa: hsva(0, 86%, 69%, 0.69)
RGBa: rgba(176, 25, 25, 0.69)
HEXa: #B01919B0
RGB: rgb(176, 25, 25)
HEX: #B01919
```

You can use this feature when writing migrations.

We also provide a color converter service for your needs [here](lib/ColorConverter/ColorConverter.php).

### Acknowledgement

This bundle uses Pickr (https://github.com/Simonwep/pickr) under the MIT Licence.
