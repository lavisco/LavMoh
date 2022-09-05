<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="color-scheme" content="light" />
        <meta name="supported-color-schemes" content="light" />
        <style>
            .card {
                display: flex;
                flex-direction: column;
                width: 100%;
                border: 2px solid #f7f7f7;
                border-radius: 8px;
            }

            .card-row {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                width: 100%;
            }
            .card-row-compact {
                display: flex;
                flex-direction: row;
            }
            .card-col {
                display: flex;
                flex-direction: column;
            }

            .card-header {
                background-color: #f7f7f7;
                border-bottom: 2px solid #eeeded;
                padding: 8px 16px;
                color: #707070;
                font-size: 14px;
                width: 100%;
            }

            .card-footer {
                background-color: #f7f7f7;
                border-top: 2px solid #eeeded;
                padding: 8px 16px;
                display: flex;
                flex-direction: row;
                justify-content: flex-end;
                font-size: 19px;
                font-weight: bolder;
                color: #333333;
                width: 100%;
            }

            .card-sub-footer {
                padding: 8px 16px;
                display: flex;
                flex-direction: row;
                justify-content: flex-end;
                width: 100%;
            }

            .card-body {
                padding: 16px;
                border-bottom: 2px solid #f7f7f7;
            }

            .card-price {
                width: 90px;
                text-align: right !important;
            }

            .card-grey {
                padding: 24px;
                background-color: #f7f7f7;
                border-radius: 8px;
                height: initial;
            }

            .grey {
                color: #707070;
            }

            .text-sm {
                font-size: 14px;
            }
            .text-left {
                text-align: left;
            }

            .w-50 {
                width: 47%;
            }

            .w-30 {
                width: 31%;
            }

            .h-100 {
                height: 100%;
            }
            .img-box {
                width: 60px;
                height: 60px;
                border-radius: 8px;
            }

            .mr-2 {
                margin-right: 16px;
            }
            .mr-3 {
                margin-right: 24px;
            }
            .mb-1 {
                margin-bottom: 8px;
            }
            .mb-2 {
                margin-bottom: 16px;
            }
            .mb-3 {
                margin-bottom: 24px;
            }
            .mb-4 {
                margin-bottom: 32px;
            }
            @media only screen and (max-width: 600px) {
                .inner-body {
                    width: 100% !important;
                }

                .footer {
                    width: 100% !important;
                }
                .w-50 {
                    width: 100% !important;
                }
                .w-30 {
                    width: 100% !important;
                }
                .mb-sm-2 {
                    margin-bottom: 16px;
                }
                .content-cell {
                    padding: 24px !important;
                }
            }

            @media only screen and (max-width: 500px) {
                .button {
                    width: 100% !important;
                }
            }
        </style>
    </head>
    <body>
        <table
            class="wrapper"
            width="100%"
            cellpadding="0"
            cellspacing="0"
            role="presentation"
        >
            <tr>
                <td align="center">
                    <table
                        class="content"
                        width="100%"
                        cellpadding="0"
                        cellspacing="0"
                        role="presentation"
                    >
                        {{
                            $header ?? ""
                        }}

                        <!-- Email Body -->
                        <tr>
                            <td
                                class="body"
                                width="100%"
                                cellpadding="0"
                                cellspacing="0"
                            >
                                <table
                                    class="inner-body"
                                    align="center"
                                    width="570"
                                    cellpadding="0"
                                    cellspacing="0"
                                    role="presentation"
                                >
                                    <!-- Body content -->
                                    <tr>
                                        <td class="content-cell">
                                            {{ Illuminate\Mail\Markdown::parse($slot) }}

                                            {{ $subcopy ?? "" }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        {{
                            $footer ?? ""
                        }}
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
