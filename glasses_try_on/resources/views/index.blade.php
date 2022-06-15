<!DOCTYPE html>
<html>
<head>
    <title>Shades try on</title>
    <meta charset='utf-8' />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function($)
        {

            $('.headerTitle').click(function(){
                $(".container-menu").removeClass("change");
                $(".Jeeliz_btns").removeClass("menu-change");
            });
            $('.productSummary , .side_btns button').click(function(){
                $('.productSummary').removeClass('current');
                $(this).addClass('current');
                $(".container-menu").removeClass("change");
                $(".Jeeliz_btns").removeClass("menu-change");
            });

            $('.container-menu').click(function(){
                $(".container-menu").toggleClass("change");
                $(".Jeeliz_btns").toggleClass("menu-change");

            });

        });
    </script>
    <!-- Forbid resize on pinch with IOS Safari: -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
    <!-- INCLUDE MAIN SCRIPT: -->
    <script src='{{asset('JeelizVTOWidget.js')}}'></script>
    <!-- For icons adjust fame or resize canvas -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <!-- Font for the header only: -->
    <link href="https://fonts.googleapis.com/css?family=castellar" rel="stylesheet">
    <!-- main stylesheet: -->
    <link rel='stylesheet' href='{{asset('JeelizVTOWidget.css')}}' />

    <script>
        let _isResized = false;
        function test_resizeCanvas() {
            // halves the height:
            let halfHeightPx = Math.round(window.innerHeight / 2).toString() + 'px';

            const domWidget = document.getElementById('JeelizVTOWidget');
            domWidget.style.maxHeight = (_isResized) ? 'none' : halfHeightPx;

            _isResized = !_isResized;
        }


        function get_initialSKU(){
            // look if a SKU is provided as a URL parameters:
            const queryString = window.location.search;
            const URLParams = new URLSearchParams(queryString);
            const sku = URLParams.get('sku') || 'rayban_aviator_or_vertFlash';
            console.log('Initial SKU =', sku);
            return sku;
        }


        // entry point:
        function main() {
            JEELIZVTOWIDGET.start({
                sku: get_initialSKU(),
                searchImageMask: 'https://appstatic.jeeliz.com/jeewidget/images/target.png',
                searchImageColor: 0xeeeeee,
                callbackReady: function(){
                    console.log('INFO: JEELIZVTOWIDGET is ready :)');

                    // add a LUT to change video rendering:
                    //JEELIZVTOWIDGET.set_LUT('images/LUTs/LUTGrayscale.png');
                    //JEELIZVTOWIDGET.set_LUT('images/LUTs/LUTImprove.jpg');
                },
                onError: function(errorLabel){ // this function catches errors, so you can display custom integrated messages
                    alert('An error happened. errorLabel =' + errorLabel)
                    switch(errorLabel) {
                        case 'WEBCAM_UNAVAILABLE':
                            // the user has no camera, or does not want to share it.
                            break;

                        case 'NOFILE':
                            // the user send an image, but it is not here
                            break;

                        case 'WRONGFILEFORMAT':
                            // the user upload a file which is not an image or corrupted
                            break;

                        case 'INVALID_SKU':
                            // the provided SKU does not match with a glasses model
                            break;

                        case 'FALLBACK_UNAVAILABLE':
                            // we cannot switch to file upload mode. browser too old?
                            break;

                        case 'PLACEHOLDER_NULL_WIDTH':
                        case 'PLACEHOLDER_NULL_HEIGHT':
                            // Something is wrong with the placeholder
                            // (element whose id='JeelizVTOWidget')
                            break;

                        case 'FATAL':
                        default:
                            // a bit error happens:(
                            break;
                    } // end switch
                } // end onError()
            }) // end JEELIZVTOWIDGET.start call
        } // end main()


        function load_modelBySKU(){
            const sku = prompt('Please enter a glasses model SKU:', 'rayban_wayfarer_havane_marron');
            if (sku){
                JEELIZVTOWIDGET.load(sku);
            }
        }

    </script>
</head>
<body onload="main()">
<div class='content'>
    <div class='header'>
        <div class="container-menu">
            <img src="{{asset('wybierz.png')}}">
        </div>
        <div class="headerTitle">
            EYEWEARPOLAND
        </div>
    </div>
    <!-- Please keep the same element IDs so that JEELIZVTOWIDGET can extract them from the DOM -->
    <!-- BEGIN JEELIZVTOWIDGET -->
    <!--
       div with id='JeelizVTOWidget' is the placeholder
       you need to size and position it according to where the VTO widget should be
       if you resize it, the widget will be automatically resized
       -->
    <div id='JeelizVTOWidget'>
        <!-- MAIN CANVAS: -->
        <!--
           canvas with id='JeelizVTOWidgetCanvas' is the canvas where the VTO widget will be rendered
           it should have CSS attribute position: absolute so that it can be resized without
           changing the total size of the placeholder
           -->
        <div class="Jeeliz_custom">

            <div class="Jeeliz_btns">
                <!-- CHANGE MODEL BUTTONS: -->
                <div class='JeelizVTOWidgetControls' id='JeelizVTOWidgetChangeModelContainer'>

                    <div class="jeeCarouzelSlider__item jeeCarouzelSlider__item__unselected">
                        @foreach($glasses as $singleObj)
                        <div class="productSummary productSummary__unselected" onclick="JEELIZVTOWIDGET.load({{$singleObj->sku}})">
                            <div class="productSummary__imgPrice">
                                <div class="productSummary__imgPrice__container">
                                    <img draggable="false" alt="Glasses Frame" src="{{$singleObj->img}}"></div>
                            </div>
                            <div class="productSummary__titleSeeMore">
                                <div class="productSummary__title">{{$singleObj->label}}</div>
                                <div class="productSummary__titleSeeMore__seeMore">

                                    <button class="price__span" @if($singleObj->is_static)onclick="JEELIZVTOWIDGET.load_modelStandalone('{{asset('glasses3D/'.$singleObj->sku.'.json')}}')"
                                        @else
                                        onclick="JEELIZVTOWIDGET.load('{{$singleObj->sku}}')"
                                        @endif
                                        >
                                        Przymierz<span>{{$singleObj->price}}</span>

                                    </button>
                                    <button class="cart_btn">
                                        <i class="fas fa-shopping-cart"></i>
                                        Kupić
                                    </button>






                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>


                </div>
            </div>
            <div class="side_btns">
                <!-- ADJUST BUTTON: -->
                <button id='JeelizVTOWidgetAdjust'>
                    <div class="buttonIcon"><i class="fas fa-arrows-alt"></i></div>
                    Dostosuj
                </button>
                <!-- RESIZE WIDGET BUTTON: -->
                <button id='buttonResizeCanvas' onclick='test_resizeCanvas();'>
                    <div class="buttonIcon"><i class="fas fa-sync-alt"></i></div>
                    Zmień widok
                </button>
            </div>
            <canvas id='JeelizVTOWidgetCanvas'></canvas>
        </div>
        <!-- BEGIN ADJUST NOTICE -->
        <div id='JeelizVTOWidgetAdjustNotice'>
            Przesuń okulary, aby je dostosować.
            <button class='JeelizVTOWidgetBottomButton' id='JeelizVTOWidgetAdjustExit'>Zamkni</button>
        </div>
        <!-- END AJUST NOTICE -->
        <!-- BEGIN LOADING WIDGET (not model) -->
        <div id='JeelizVTOWidgetLoading'>
            <div class='JeelizVTOWidgetLoadingText'>
                LOADING...
            </div>
        </div>
        <!-- END LOADING -->
    </div>
</div>










</body>
</html>
