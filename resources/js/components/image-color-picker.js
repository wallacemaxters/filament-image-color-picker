
export default function canvasColorPicker({
    image,
    state,
    format,
    isLive
}) {

    function loadImage(src) {

        const img = new Image();
        img.crossOrigin = '';
        img.src = src;

        return new Promise((resolve, reject) => {
            img.complete ? resolve(img) : img.addEventListener('load', () => resolve(img))
            img.addEventListener('error', reject);
        })
    }

    function rgbToHsl(r, g, b) {

        // Make r, g, and b fractions of 1
        r /= 255;
        g /= 255;
        b /= 255;

        // Find greatest and smallest channel values
        let cmin = Math.min(r, g, b),
            cmax = Math.max(r, g, b),
            delta = cmax - cmin,
            h = 0,
            s = 0,
            l = 0;


        // Calculate hue
        // No difference
        if (delta == 0)
            h = 0;
        // Red is max
        else if (cmax == r)
            h = ((g - b) / delta) % 6;
        // Green is max
        else if (cmax == g)
            h = (b - r) / delta + 2;
        // Blue is max
        else
            h = (r - g) / delta + 4;

        h = Math.round(h * 60);

        // Make negative hues positive behind 360°
        if (h < 0)
            h += 360;

        // Calculate lightness
        l = (cmax + cmin) / 2;

        // Calculate saturation
        s = delta == 0 ? 0 : delta / (1 - Math.abs(2 * l - 1));

        // Multiply l and s by 100
        s = +(s * 100).toFixed(1);
        l = +(l * 100).toFixed(1);

        return "hsl(" + h + "," + s + "%," + l + "%)";
    }

    function colorHex(r, g, b) {
        const hex = [r, g, b].map((number) => number.toString(16).padStart(2, '0').toUpperCase()).join('');

        return `#${hex}`;
    }

    function colorRgb(r, g, b) {
        return `rgb(${r}, ${g}, ${b})`;
    }

    function formatColor(color) {

        if (format === 'hex') {
            return colorHex(color[0], color[1], color[2]);
        } else if (format === 'hsl') {
            return rgbToHsl(color[0], color[1], color[2]);
        }

        return colorRgb(color[0], color[1], color[2])
    }

    return {

        /**
         * @type {HTMLCanvasElement|null}
         */
        canvas: null,

        previewColor: null,

        previewColorTimeout: 0,

        selectedColor: state,

        x: 0,
        y: 0,

        clientX: 0,
        clientY: 0,

        init() {
            /**
             * @type {HTMLCanvasElement}
             */
            const canvas = this.$refs.canvas;

            loadImage(image).then((img) => {

                canvas.width = img.width;
                canvas.height = img.height;

                const ctx = canvas.getContext('2d');

                console.log(img.src)

                ctx.drawImage(img, 0, 0);
            })

            this.canvas = canvas;
        },

        onClick(e) {

            this.selectColor(e);

            this.selectedColor = this.previewColor;

            isLive && this.$wire.$commit();
        },

        selectColor(e) {

            const {
                x,
                y
            } = this.getRelativeCoordinates(e.clientX, e.clientY)

            const ctx = this.canvas.getContext('2d');

            const {
                data
            } = ctx.getImageData(x, y, 1, 1);

            this.previewColor = formatColor(data);

            this.x = x;
            this.y = y;

            this.clientX = e.clientX;
            this.clientY = e.clientY;

            clearTimeout(this.previewColorTimeout);

            this.previewColorTimeout = setTimeout(() => this.previewColor = null, 1500);

        },

        /**
         * @param {Number} eventX
         * @param {Number} eventY
         */
        getRelativeCoordinates(eventX, eventY) {

            const canvas = this.canvas;

            const rect = canvas.getBoundingClientRect();
            const scaleX = canvas.width / rect.width;
            const scaleY = canvas.height / rect.height;

            const x = (eventX - rect.left) * scaleX;
            const y = (eventY - rect.top) * scaleY;

            return {
                x,
                y
            }
        },


    }
}
