@include('layouts.web.stacks.styles')
<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.email.includes.head')
    </head>
    <body>
        <style id="media-query" type="text/css">
            /* Client-specific Styles & Reset */

            #outlook a {
                padding: 0;
            }
            /* .ExternalClass applies to Outlook.com (the artist formerly known as Hotmail) */

            .ExternalClass {
                width: 100%;
            }

            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }

            #backgroundTable {
                margin: 0;
                padding: 0;
                width: 100% !important;
                line-height: 100% !important;
            }
            /* Buttons */

            .button a {
                display: inline-block;
                text-decoration: none;
                -webkit-text-size-adjust: none;
                text-align: center;
            }

            .button a div {
                text-align: center !important;
            }
            /* Outlook First */

            body.outlook p {
                display: inline !important;
            }

            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }
            /*  Media Queries */


            @media only screen and (max-width: 600px) {
                table[class="body"] img {
                    height: auto !important;
                    width: 100% !important;
                }
                table[class="body"] img.fullwidth {
                    max-width: 100% !important;
                }
                table[class="body"] center {
                    min-width: 0 !important;
                }
                table[class="body"] .container {
                    width: 95% !important;
                }
                table[class="body"] .row {
                    width: 100% !important;
                    display: block !important;
                }
                table[class="body"] .wrapper {
                    display: block !important;
                    padding-right: 0 !important;
                }
                table[class="body"] .columns,
                table[class="body"] .column {
                    table-layout: fixed !important;
                    float: none !important;
                    width: 100% !important;
                    padding-right: 0px !important;
                    padding-left: 0px !important;
                    display: block !important;
                }
                table[class="body"] .wrapper.first .columns,
                table[class="body"] .wrapper.first .column {
                    display: table !important;
                }
                table[class="body"] table.columns td,
                table[class="body"] table.column td,
                .col {
                    width: 100% !important;
                }
                table[class="body"] table.columns td.expander {
                    width: 1px !important;
                }
                table[class="body"] .right-text-pad,
                table[class="body"] .text-pad-right {
                    padding-left: 10px !important;
                }
                table[class="body"] .left-text-pad,
                table[class="body"] .text-pad-left {
                    padding-right: 10px !important;
                }
                table[class="body"] .hide-for-small,
                table[class="body"] .show-for-desktop {
                    display: none !important;
                }
                table[class="body"] .show-for-small,
                table[class="body"] .hide-for-desktop {
                    display: inherit !important;
                }

                table[align="center"] {margin: 0 auto;}

                .mixed-two-up .col {
                    width: 100% !important;
                }
                .num4 {
                    margin-bottom:20px;
                    max-width:320px !important;
                }
                .mobile-hidden {
                    width: 0 !important;
                    height:0 !important;
                    overflow: hidden;
                }
                #show {
                    width: 0 !important;
                    display: none;
                }
            }

            @media screen and (max-width: 600px) {
                div[class="col"] {
                    width: 100% !important;
                }
            }

            @media screen and (min-width: 601px) {
                table[class="container"] {
                    width: 600px !important;
                }
            }
        </style>

        <!-- email container -->
       @yield('content')
    </body>
</html>