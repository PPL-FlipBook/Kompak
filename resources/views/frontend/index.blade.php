<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style type="text/css">
    body {
        background-color: #333;
        margin: 0;
        padding: 0;
    }
    .container {
        height: 95vh;
        width: 95%;
        margin: 20px auto;
        border: 2px solid red;
        box-shadow: 0 0 5px red;
    }
    .fullscreen {
        background-color: #333;
    }
    .examples {
        position: relative;
    }
    .examples div {
        position: absolute;
        text-align: center;
        width: 100%;
        padding-top: 10px;
        font-size: 20px;
    }
    .examples a {
        color: #ccc;
        text-decoration: none;
        padding: 0 10px;
    }
    .examples a:hover {
        color: #fff;
    }
</style>
<body>
<div class="examples">
    <div>
        <a href="{{ route('frontend.fe') }}">Lightbox</a>
    </div>
</div>

<div class="container fullscreen">
    <div class="sample-container-box" id="flipbook-container">
        <div class="sample-container flip-book-container" src="{{ asset('storage/books/pdf/'.$book->pdf_file) }}">
        </div>
    </div>
</div>

<script src="{{asset('assets-fe1/js/jquery.min.js')}}"></script>
<script src="{{asset('assets-fe1/js/html2canvas.min.js')}}"></script>
<script src="{{asset('assets-fe1/js/flipbook.min.js')}}"></script>
<script src="{{asset('assets-fe1/js/3dflipbook.min.js')}}"></script>

<script src="{{asset('assets-fe1/js/default-book-view.js')}}"></script>
<script type="text/javascript">

    // // Sample 0 {
    // $('#container').FlipBook({
    //   pdf: 'books/pdf/FoxitPdfSdk.pdf',
    //   template: {
    //     html: 'templates/default-book-view.html',
    //     styles: [
    //       'css/short-black-book-view.css'
    //     ],
    //     links: [
    //       {
    //         rel: 'stylesheet',
    //         href: 'css/font-awesome.min.css'
    //       }
    //     ],
    //     script: 'js/default-book-view.js'
    //   }
    // });
    // // }

    // Sample 1 CSS Layer {
    function theKingIsBlackPageCallback(n) {
        return {
            type: 'image',
            src: 'books/image/theKingIsBlack/'+(n+1)+'.jpg',
            interactive: false
        };
    }

    $('#flipbook-container').FlipBook({
        pdf: '{{ asset('storage/books/pdf/'.$book->pdf_file) }}',
        template: {
            html: '{{asset('assets-fe1/templates/default-book-view.html')}}',
            styles: [
                '{{asset('assets-fe1/css/short-white-book-view.css')}}'
            ],
            script: '{{{asset('assets-fe1/js/default-book-view.js')}}}'
        }
    });

    $('#container').FlipBook({
        pageCallback: theKingIsBlackPageCallback,
        pages: 40,
        propertiesCallback: function(props) {
            props.cssLayersLoader = function(n, clb) {// n - page number
                clb([{
                    css: '.hd {margin-top: 200px;background-color: red;}',
                    html: '<h1 class="hd">CSS3 Layer - Hello</h1>',
                    js: function (jContainer) {
                        console.log(jContainer);
                        return {
                            hide: function() {console.log('hide');},
                            hidden: function() {console.log('hidden');},
                            show: function() {console.log('show');},
                            shown: function() {console.log('shown');},
                            dispose: function() {console.log('dispose');}
                        };
                    }
                }]);
            };
            props.cover.color = 0x000000;
            return props;
        },
        template: {
            html: '{{(asset('assets-fe1/templates/default-book-view.html'))}}',
            styles: [
                '{{(asset('assets-fe1/css/short-white-book-view.css'))}}'
            ],
            links: [
                {
                    rel: 'stylesheet',
                    href: '{{(asset('assets-fe1/css/font-awesome.min.css'))}}'
                }
            ],
            script: '{{(asset('assets-fe1/js/default-book-view.js'))}}',
            sounds: {
                startFlip: '{{(asset('assets-fe1/sounds/start-flip.mp3'))}}',
                endFlip: '{{(asset('assets-fe1/sounds/end-flip.mp3'))}}'
            }
        }
    });
    // }

    // // Sample 2 {
    // $('#container').FlipBook({
    //   pdf: 'books/pdf/CondoLiving.pdf',
    //   pages: 5,
    //   template: {
    //     html: 'templates/default-book-view.html',
    //     styles: [
    //       'css/white-book-view.css'
    //     ],
    //     links: [
    //       {
    //         rel: 'stylesheet',
    //         href: 'css/font-awesome.min.css'
    //       }
    //     ],
    //     script: 'js/default-book-view.js'
    //   }
    // });
    // // }

    // // Sample 3 {
    // $('#container').FlipBook({
    //   pdf: 'books/pdf/TheThreeMusketeers.pdf',
    //   propertiesCallback: function(props) {
    //     props.page.depth /= 2.5;
    //     props.cover.padding = 0.002;
    //     return props;
    //   },
    //   template: {
    //     html: 'templates/default-book-view.html',
    //     styles: [
    //       'css/short-black-book-view.css'
    //     ],
    //     links: [
    //       {
    //         rel: 'stylesheet',
    //         href: 'css/font-awesome.min.css'
    //       }
    //     ],
    //     script: 'js/default-book-view.js'
    //   }
    // });
    // // }

    // // Sample 4 {
    // function preview(n) {
    //   return {
    //     type: 'html',
    //     src: 'books/html/preview/'+(n%3+1)+'.html',
    //     interactive: true
    //   };
    // }
    //
    // $('#container').FlipBook({
    //   pageCallback: preview,
    //   pages: 20,
    //   propertiesCallback: function(props) {
    //     props.sheet.color = 0x008080;
    //     props.cover.padding = 0.002;
    //     return props;
    //   },
    //   template: {
    //     html: 'templates/default-book-view.html',
    //     styles: [
    //       'css/black-book-view.css'
    //     ],
    //     links: [
    //       {
    //         rel: 'stylesheet',
    //         href: 'css/font-awesome.min.css'
    //       }
    //     ],
    //     script: 'js/default-book-view.js'
    //   }
    // });
    // // }

</script>

</body>
</html>
