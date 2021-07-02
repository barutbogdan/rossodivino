<style>
    .middle-boxes-section {
        position: relative;
    }

    .middle-boxes-section .box {
        height: 182px;
    }

    .middle-boxes-section .box:first-child {
        background: linear-gradient(to right, #0194c8, #033663);
    }

    .middle-boxes-section .box:last-child {
        background: linear-gradient(to right, #d53c1d, #fed549);
    }

    .middle-boxes-section .cover-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .middle-boxes-section .cover-container .area div {
        display: inline-block;
        vertical-align: middle;
    }

    .middle-boxes-section .cover-container .area div h2 {
        margin-bottom: 10px;
        color: #ffffff;
        font-weight: normal;
        font-size: 36px;
        line-height: 1.3em;
        letter-spacing: 0.3px;
        font-family: Oswald Regular, Arial, Helvetica, sans-serif;
    }

    .middle-boxes-section .cover-container .area div h4 {
        padding: 0;
        color: #eee;
        font-family: Heebo Light, Arial, Helvetica, sans-serif;
        font-size: 22px;
    }

    .middle-boxes-section .cover-container .area a {
        line-height: 54px;
        height: 54px;
        max-width: 155px;
        float: right;
        font-size: 17px;
        font-family: Oswald Bold, Arial, Helvetica, sans-serif;
        margin-top: 5px;
    }

    .middle-boxes-section .cover-container .area:first-child {
        padding-right: 35px;
    }

    .middle-boxes-section .cover-container .area:last-child {
        padding-left: 35px;
    }

    .middle-boxes-section .cover-container .area:last-child a {
        background: #003056;
        color: #ffffff;
    }

    .middle-boxes-section .cover-container .area:last-child a:hover {
        background: #044a7f;
    }
</style>
<div class="middle-boxes-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 box"></div>
        </div>
    </div>
    <div class="container cover-container">
        <div class="row">
            <div class="col-lg-6 area n">
                <div>
                    <h2>{{ trans('homepage.financing_available') }}</h2>
                    <h4>{{ trans('homepage.with_approved_credit') }}</h4>
                </div>
                <a href="" title="{{ trans('homepage.learn_more_text') }}" class="main-btn">{{ trans('homepage.learn_more_text') }}</a>
            </div>
            <div class="col-lg-12 area">
                <div>
                    <h2>{{ trans('homepage.join_our_team') }}</h2>
                    <h4>{{ trans('homepage.jobs_available') }}</h4>
                </div>
                @if($career = page('CareersController'))
                    <a href="{{ $career->path }}" title="{{ trans('homepage.learn_more_text') }}" class="main-btn">{{ trans('homepage.learn_more_text') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
