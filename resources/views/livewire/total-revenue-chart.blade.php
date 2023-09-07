<div>
    <canvas
        x-data="{
            chart: null,

            init: function () {
                let chart = new Chart($el, {
                    type: 'line',
                    data: @js($this->getData()),
                })
            }
        }"
        style="height: 320px;">
    </canvas>
</div>
