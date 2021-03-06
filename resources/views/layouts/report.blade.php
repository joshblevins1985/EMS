<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Medidex|Solutions">
    <meta name="author" content="Joshua Blevins">
    <meta name="keyword" content="EMS, Dispatch, Software, Narcotics, Time, Attendance">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <title>Medidex|Solutions</title>
    <!-- Main styles for this application-->
    @stack('css')
    <style>
        table, tr, td, th, tbody, thead, tfoot {
            page-break-inside: avoid !important;
        }
        .element-wrapper {
            padding-bottom: 3rem;
        }

        .element-wrapper .btn + .btn, .element-wrapper .all-wrapper .fc-button + .btn, .all-wrapper .element-wrapper .fc-button + .btn, .element-wrapper .all-wrapper .btn + .fc-button, .all-wrapper .element-wrapper .btn + .fc-button, .element-wrapper .all-wrapper .fc-button + .fc-button, .all-wrapper .element-wrapper .fc-button + .fc-button {
            margin-left: 1rem;
        }

        .element-wrapper.compact {
            padding-bottom: 2rem;
        }

        .element-wrapper.folded {
            padding-bottom: 2rem;
        }

        .element-wrapper.folded .element-header {
            margin-bottom: 0px;
        }

        .element-wrapper .element-info {
            padding-bottom: 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .element-wrapper .element-info .element-info-with-icon {
            margin-bottom: 0px;
        }

        .element-wrapper .element-info-with-icon {
            display: -webkit-box;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            margin-bottom: 2rem;
        }

        .element-wrapper .element-info-with-icon .element-info-icon {
            -webkit-box-flex: 0;
            flex: 0 0 70px;
            color: #047bf8;
            font-size: 30px;
        }

        .element-wrapper .element-info-with-icon.smaller .element-info-icon {
            -webkit-box-flex: 0;
            flex: 0 0 50px;
            font-size: 20px;
        }

        .element-wrapper .element-info-with-icon.smaller .element-info-text .element-inner-header {
            margin-bottom: 0px;
        }

        .element-wrapper .element-actions {
            float: right;
            position: relative;
            z-index: 2;
            margin-top: -0.2rem;
        }

        .element-wrapper .element-actions select.form-control-sm,
        .element-wrapper .element-actions input.form-control-sm {
            height: 1.75rem;
        }

        .element-wrapper .element-actions .form-control + .form-control {
            margin-left: 10px;
        }

        .element-wrapper .element-actions .btn + .btn, .element-wrapper .element-actions .all-wrapper .fc-button + .btn, .all-wrapper .element-wrapper .element-actions .fc-button + .btn, .element-wrapper .element-actions .all-wrapper .btn + .fc-button, .all-wrapper .element-wrapper .element-actions .btn + .fc-button, .element-wrapper .element-actions .all-wrapper .fc-button + .fc-button, .all-wrapper .element-wrapper .element-actions .fc-button + .fc-button {
            margin-left: 10px;
        }

        .element-wrapper .element-actions label {
            margin-right: 7px;
            color: rgba(90, 99, 126, 0.49);
        }

        .element-wrapper .element-actions.actions-only {
            margin-top: 0px;
        }

        .element-wrapper .element-actions .element-action {
            text-decoration: none;
            color: rgba(90, 99, 126, 0.49);
        }

        .element-wrapper .element-actions .element-action:hover {
            color: #3E4B5B;
        }

        .element-wrapper .element-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding-bottom: 1rem;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }

        .element-wrapper .element-header:after {
            content: "";
            background-color: #047bf8;
            width: 25px;
            height: 4px;
            border-radius: 0px;
            display: block;
            position: absolute;
            bottom: -3px;
            left: 0px;
        }

        .element-wrapper .element-inner-header {
            margin-bottom: 0.5rem;
            margin-top: 0px;
            display: block;
        }

        .element-wrapper .element-inner-desc {
            color: #999;
            font-weight: 300;
            font-size: 0.81rem;
            display: block;
        }

        .element-wrapper .element-search {
            position: relative;
        }

        .element-wrapper .element-search:before {
            /* use !important to prevent issues with browser extensions that change fonts */
            font-family: 'osfont' !important;
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            /* Better Font Rendering =========== */
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            position: absolute;
            left: 15px;
            top: 48%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            font-size: 20px;
            content: "\e92c";
            color: rgba(0, 0, 0, 0.2);
        }

        .element-wrapper .element-search input {
            border: none;
            box-shadow: none;
            background-color: #f1f1f1;
            border-radius: 30px;
            padding: 10px 15px 10px 50px;
            display: block;
            width: 100%;
            outline: none;
        }

        .element-wrapper .element-search input::-webkit-input-placeholder {
            color: rgba(0, 0, 0, 0.3);
        }

        .element-wrapper .element-search input::-moz-placeholder {
            color: rgba(0, 0, 0, 0.3);
        }

        .element-wrapper .element-search input:-ms-input-placeholder {
            color: rgba(0, 0, 0, 0.3);
        }

        .element-wrapper .element-search input::-ms-input-placeholder {
            color: rgba(0, 0, 0, 0.3);
        }

        .element-wrapper .element-search input::placeholder {
            color: rgba(0, 0, 0, 0.3);
        }

        .box-style, .user-profile, .element-box, .invoice-w, .big-error-w, .activity-boxes-w .activity-box, .post-box, .projects-list .project-box, .order-box, .ecommerce-customer-info {
            border-radius: 6px;
            background-color: #fff;
            box-shadow: 0px 2px 4px rgba(126, 142, 177, 0.12);
        }

        .element-box, .invoice-w, .big-error-w {
            padding: 1.5rem 2rem;
            margin-bottom: 1rem;
        }

        .element-box.less-padding, .less-padding.invoice-w, .less-padding.big-error-w {
            padding: 1rem;
        }

        .element-box .os-tabs-controls, .invoice-w .os-tabs-controls, .big-error-w .os-tabs-controls {
            margin-left: -2rem;
            margin-right: -2rem;
        }

        .element-box .os-tabs-controls .nav, .invoice-w .os-tabs-controls .nav, .big-error-w .os-tabs-controls .nav {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .element-box .centered-header, .invoice-w .centered-header, .big-error-w .centered-header {
            text-transform: uppercase;
            letter-spacing: 2px;
            text-align: center;
            margin-bottom: 1rem;
        }

        .element-box .element-box-header, .invoice-w .element-box-header, .big-error-w .element-box-header {
            color: #046fdf;
            margin-bottom: 1rem;
        }

        .element-box-content + .form-header {
            margin-top: 2rem;
        }

        .element-box + .element-box, .invoice-w + .element-box, .big-error-w + .element-box, .element-box + .invoice-w, .invoice-w + .invoice-w, .big-error-w + .invoice-w, .element-box + .big-error-w, .invoice-w + .big-error-w, .big-error-w + .big-error-w {
            margin-top: 2rem;
        }

        .element-box-tp .input-search-w,
        .element-box .input-search-w,
        .invoice-w .input-search-w,
        .big-error-w .input-search-w {
            margin-bottom: 1rem;
        }
        .el-tablo {
            display: block;
        }

        .el-tablo:not(.centered) {
            padding-right: 5px;
        }

        .el-tablo .label {
            display: block;
            font-size: 0.63rem;
            text-transform: uppercase;
            color: rgba(0, 0, 0, 0.4);
            letter-spacing: 1px;
        }

        .el-tablo .value {
            font-size: 2.43rem;
            font-weight: 500;
            font-family: "Avenir Next W01", "Lato", -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            letter-spacing: 1px;
            line-height: 1.2;
            display: inline-block;
            vertical-align: middle;
        }

        .el-tablo .trending {
            padding: 3px 10px;
            border-radius: 30px;
            display: inline-block;
            font-size: 0.81rem;
            vertical-align: middle;
            margin-left: 10px;
        }

        .el-tablo .trending .os-icon {
            margin-left: 2px;
            vertical-align: middle;
            font-size: 14px;
        }

        .el-tablo .trending span {
            display: inline-block;
            vertical-align: middle;
        }

        .el-tablo .trending-up {
            color: #fff;
            background-color: #24b314;
        }

        .el-tablo .trending-down {
            color: #fff;
            background-color: #e65252;
        }

        .el-tablo .trending-up-basic {
            color: #24b314;
            padding: 0px;
        }

        .el-tablo .trending-down-basic {
            color: #e65252;
            padding: 0px;
        }

        .el-tablo.trend-in-corner {
            position: relative;
        }

        .el-tablo.trend-in-corner .trending {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 2px 4px;
            border-radius: 4px;
            line-height: 1.2;
            font-size: 0.63rem;
        }

        .el-tablo.trend-in-corner .trending i {
            font-size: 12px;
        }

        .el-tablo.centered {
            text-align: center;
            padding-left: 10px;
            padding-right: 10px;
        }

        .el-tablo.centered.padded {
            padding-left: 10px;
            padding-right: 10px;
        }

        .el-tablo.padded {
            padding: 2rem;
        }

        .el-tablo.bigger .value {
            font-size: 3.33rem;
        }

        .el-tablo.bigger .label {
            font-size: 0.9rem;
        }

        .el-tablo.smaller .value {
            font-size: 1.71rem;
        }

        .el-tablo.smaller .label {
            font-size: 0.63rem;
            letter-spacing: 2px;
        }

        .el-tablo.smaller.trend-in-corner .trending {
            top: 3px;
            right: 3px;
        }

        .el-tablo.highlight .value {
            color: #047bf8;
        }

        .el-tablo.bold-label .label {
            text-transform: none;
            font-size: 0.99rem;
            letter-spacing: 0px;
        }

        a.el-tablo {
            text-decoration: none;
            display: block;
            color: #3E4B5B;
            -webkit-transition: all 0.25s ease;
            transition: all 0.25s ease;
        }

        a.el-tablo .value {
            -webkit-transition: all 0.25s ease;
            transition: all 0.25s ease;
        }

        a.el-tablo .label {
            -webkit-transition: all 0.25s ease;
            transition: all 0.25s ease;
        }

        a.el-tablo:hover {
            -webkit-transform: translateY(-5px) scale(1.02);
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0px 5px 12px rgba(126, 142, 177, 0.2);
        }

        a.el-tablo:hover .value {
            -webkit-transform: translateY(-3px);
            transform: translateY(-3px);
            color: #047bf8;
        }

        a.el-tablo:hover .label {
            color: #3395fc;
        }

        a.el-tablo:hover.centered .value {
            -webkit-transform: scale(1.1) translateY(-3px);
            transform: scale(1.1) translateY(-3px);
        }

        a.el-tablo:hover .label {
            -webkit-transform: translateY(-2px);
            transform: translateY(-2px);
        }

        .el-buttons-list .btn, .el-buttons-list .all-wrapper .fc-button, .all-wrapper .el-buttons-list .fc-button {
            margin: 0px;
            margin-bottom: 0.5rem;
        }

        .el-buttons-list .btn + .btn, .el-buttons-list .all-wrapper .fc-button + .btn, .all-wrapper .el-buttons-list .fc-button + .btn, .el-buttons-list .all-wrapper .btn + .fc-button, .all-wrapper .el-buttons-list .btn + .fc-button, .el-buttons-list .all-wrapper .fc-button + .fc-button, .all-wrapper .el-buttons-list .fc-button + .fc-button {
            margin-left: 0px;
        }

        .el-buttons-list.full-width .btn, .el-buttons-list.full-width .all-wrapper .fc-button, .all-wrapper .el-buttons-list.full-width .fc-button {
            display: block;
        }

        .el-tablo + .el-chart-w {
            margin-top: 1rem;
        }
        .callout {
            padding: 20px;
            margin: 20px 0;
            border: 2px solid gray;
            border-left-width: 5px;
            border-radius: 3px;
        }


        .callout-immediate{
            border-left-color: red;
        }
        .callout-urgent{
            border-left-color: darkorange;
        }
        .callout-medium{
            border-left-color: yellow;
        }
        .callout-scheduled{
            border-left-color: greenyellow;
        }
    </style>
</head>
<body>

<div class="c-wrapper">

    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
    </div>

</div>

</body>
</html>
