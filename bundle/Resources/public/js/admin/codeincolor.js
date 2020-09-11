import '../../pickr/dist/themes/classic.min.css';
import Pickr from '../../pickr/dist/pickr.es5.min';

(function(global) {
    global.codeinColor = {
        formParams: [],
        createPickr: function(params) {
            let containerElt = this.getContainer(params.container)
            let buttonElt = containerElt.querySelector('.codeincolor__button')
            let currentValue = this.getInputValue(containerElt, 'RGBa')
            let currentColor = null
            if(currentValue.length > 0) {
                currentColor = currentValue
            }

            this.formParams[params.container] = params.formParams

            let pickr = Pickr.create({
                theme: 'classic',
                el: buttonElt,
                default: currentColor,
                components: {
                    // Main components
                    preview: true,
                    opacity: true,
                    hue: true,

                    // Input / output Options
                    interaction: {
                        hex: true,
                        rgba: true,
                        hsla: true,
                        hsva: true,
                        cmyk: true,
                        input: true,
                        clear: true,
                        cancel: true,
                        save: true
                    }
                },
                i18n: params.i18n
            });
            pickr.on('show', (color, instance) => {
                let containerId = instance.options.el.getAttribute('data-pickr-container-id')
                let container = this.getContainer(containerId)
                if(this.formParams[containerId] != undefined && this.getInputValue(container, "HEXa").length === 0) {
                    let defaultColor = '#106d95FF'
                    if(this.formParams[containerId].defaultValue.HEXa != null) {
                        defaultColor = this.formParams[containerId].defaultValue.HEXa
                    }
                    let colorRepresentation = instance.getColorRepresentation()
                    let element = instance.getRoot().app.querySelector('input.pcr-result')
                    let event = new Event('input')
                    element.value = defaultColor
                    element.dispatchEvent(event)
                    instance.setColorRepresentation(colorRepresentation)
                }
            })
            pickr.on('save', (color, instance) => {
                let container = this.getContainer(instance.options.el.getAttribute('data-pickr-container-id'))
                if(container !== null) {
                    if(color === null) {
                        this.setInputValue(container, 'RGBa', "")
                        this.setInputValue(container, 'HEXa', "")
                        this.setInputValue(container, 'HSVa', "")
                        this.setInputValue(container, 'RGB', "")
                        this.setInputValue(container, 'HEX', "")
                    } else {
                        this.setInputValue(container, 'RGBa', color.toRGBA().toString(0))
                        this.setInputValue(container, 'HEXa', color.toHEXA().toString(0))
                        this.setInputValue(container, 'HSVa', color.toHSVA().toString(0))
                        this.setInputValue(container, 'RGB', this.getRGBValue(color))
                        this.setInputValue(container, 'HEX', this.getHEXValue(color))
                    }
                }
                instance.hide();
            })
            pickr.on('cancel', (color, instance) => {
                instance.hide();
            })
        },
        getContainer: function(containerId) {
            return document.getElementById(containerId)
        },
        getInput: function(container, colorType) {
            return container.querySelector("[id$='" + colorType + "']")
        },
        getInputValue: function(container, colorType) {
            let input = this.getInput(container, colorType)
            if(input !== null) {
                return input.value
            }
            return "";
        },
        setInputValue: function(container, colorType, value) {
            let input = this.getInput(container, colorType)
            if(input !== null) {
                input.value = value
            }
        },
        getRGBValue: function (color) {
            let RGBa = color.toRGBA()
            return 'rgb(' + Math.round(RGBa[0]) + ', ' + Math.round(RGBa[1]) + ', ' + Math.round(RGBa[2]) + ')'
        },
        getHEXValue: function (color) {
            let HEXa = color.toHEXA()
            let HEXString = '#' + HEXa[0] + '' + HEXa[1] + '' + HEXa[2]
            return HEXString.toUpperCase()
        },
    }
})(window, window.document, window.eZ);
