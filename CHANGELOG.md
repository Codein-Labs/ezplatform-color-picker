# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.1] - 2020-09-23
## Fixed
- Package no longer require `dev` minimum stability.

## [2.0.0] - 2020-09-23
## Changed
- Bumped minimum eZ Platform kernel requirement to eZ 3.x (so `ezsystems/ezplatform-kernel:1.0.0`).
- `Codein\eZColorPicker\FieldType\ColorPicker\Type` now extends `eZ\Publish\SPI\FieldType\Generic\Type`.

## [1.0.0] - 2020-09-23
### Added
- `codeincolor` Field Type featuring a color picker
- Color converter service
