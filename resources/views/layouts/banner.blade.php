<div id="slide-show-container" class="slide-show-container   mt-6 mb-4 ">

    <ul class="cb-slideshow">
        <li>
            <span><img class="d-block w-full" src='/storage/banner/banner-001.jpg' alt="First slide" /></span>

        </li>

        <li>
            <span><img class="d-block w-full" src='/storage/banner/banner-002.jpg' alt="Second slide" /></span>

        </li>

        <li>
            <span><img class="d-block w-full" src='/storage/banner/banner-003.jpg' alt="Third slide" /></span>

        </li>

        <li>
            <span><img class="d-block w-full" src='/storage/banner/banner-004.jpg' alt="Forth slide" /></span>

        </li>

        <li>
            <span><img class="d-block w-full" src='/storage/banner/banner-005.jpg' alt="Fifth slide" /></span>

        </li>
    </ul>

</div>
<script>
    // self executing function here
    //this script set the height of the banner slideshow according to its with
    //which is responsive.
    (function() {
        setSlideshowHeight();
        window.addEventListener('resize', function(event) {
            setSlideshowHeight();
            console.log('resize');
        });

        function setSlideshowHeight() {
            var elem = document.getElementById("slide-show-container");
            w = elem.clientWidth;
            h = w * 37/ 120;
            elem.style.height = h + 'px';
        }
    })();
</script>
