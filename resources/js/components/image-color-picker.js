
export default function canvasColorPicker({
    image,
    state,
    format
}) {

    function loadImage(src) {

        const img = new Image();
        img.src = src;

        return new Promise((resolve, reject) => {
            img.complete ? resolve(img) : img.addEventListener('load', () => resolve(img))
            img.addEventListener('error', reject);
        })
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

            this.previewColor = this.formatColor(data);

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

        colorHex(r, g, b) {
            const hex = [r, g, b].map((number) => number.toString(16).padStart(2, '0').toUpperCase()).join('');

            return `#${hex}`;
        },

        colorRgb(r, g, b) {
            return `rgb(${r}, ${g}, ${b})`;
        },

        formatColor(color) {
            return format === 'hex' ? this.colorHex(color[0], color[1], color[2]) : this.colorRgb(color[0], color[1], color[2])
        }
    }
}
