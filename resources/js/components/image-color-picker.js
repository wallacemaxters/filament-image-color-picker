
export default function canvasColorPicker({
    image,
    state
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

        selectedColor: state,

        init() {
            /**
             * @type {HTMLCanvasElement}
             */
            const canvas = this.$refs.canvas;


            loadImage(image).then((img) => {

                canvas.width = img.width;
                canvas.height = img.height;

                const ctx = canvas.getContext('2d');

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

            this.previewColor = this.rgbToHex(data[0], data[1], data[2]);

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

        rgbToHex(r, g, b) {
            const hex = [r, g, b].map((number) => number.toString(16).padStart(2, '0').toUpperCase()).join('');

            return `#${hex}`;
        }
    }
}