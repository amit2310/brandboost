<template>

    <table class="table" id="liveVisitors">
        <thead>
        <tr>
            <th style="display: none;"></th>
            <th style="display: none;"></th>
            <th><i class=""><img src="/assets/images/icon_name.png"></i>Name
            </th>
            <th><i class=""><img src="/assets/images/icon_id.png"></i>IP
                Address
            </th>
            <th><i class=""><img src="/assets/images/icon_device.png"></i>Device
            </th>
            <th><i class=""><img src="/assets/images/icon_device.png"></i>Browser
            </th>
            <th><i class=""><img src="/assets/images/icon_clock.png"></i>Online
            </th>
            <th><i class=""><img src="/assets/images/icon_source.png"></i>Source
            </th>
            <th><i class=""><img src="/assets/images/icon_source.png"></i>Action
                Perform
            </th>
            <th><i class=""><img src="/assets/images/icon_source.png"></i>Country
            </th>
            <th><i class=""><img src="/assets/images/icon_action.png"></i>
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="visitor in visitors">
            <td style="display: none;"></td>
            <td style="display: none;">{{ visitor.id }}</td>
            <td>
                <div v-if="visitor.id > 0">
                    <div class="media-left media-middle">
                        <a class="icons">
                            <user-avatar
                                :avatar="visitor.avatar"
                                :firstname="visitor.firstname"
                                :lastname="visitor.lastname"
                                :width="28"
                                :height="28"
                                :fontsize="11"
                            ></user-avatar>
                        </a>
                    </div>
                    <div class="media-left">
                        <div class="">
                            <a class="text-default text-semibold bbot">
                                {{ (visitor.uid) ? visitor.firstname +' ' +visitor.lastname : 'Annoymous' }}
                            </a>
                        </div>
                    </div>
                </div>

                <div v-else>
                    <div class="media-left media-middle">
                        <user-avatar
                            :width="28"
                            :height="28"
                            :fontsize="11"
                        ></user-avatar>
                    </div>
                    <div class="media-left">
                        <div class=""><a
                            class="text-default text-semibold bbot">Annoymous</a></div>
                    </div>
                </div>

            </td>
            <td>{{ visitor.ip_address }}</td>
            <td>
                <div class="media-left media-middle brig pr30">
                    <a class="icons">
                        <platform-image :platform="visitor.platform"></platform-image>
                    </a>
                </div>
            </td>
            <td>
                <div class="media-left media-middle brig pr30">
                    <a class="icons">
                        <browser-image :browser="visitor.browser"></browser-image>
                    </a>
                </div>
            </td>
            <td>
                <strong class="text-default text-semibold">{{ visitor.created }}
                    <!--@php
                    $timeVal = timeAgo(visitor.created);
                    $timeArray = explode(' ', $timeVal);
                    echo (($timeArray[0] <= 30 && ($timeArray[1] == 'minutes' || $timeArray[1] == 'minute')) ||
                    ($timeArray[0] <= 60 && ($timeArray[1] == 'seconds' || $timeArray[1] == 'second'))) ? 'Online' :
                    $timeVal
                    @endphp-->
                </strong>
            </td>
            <td>
                <div class="text-muted">{{ visitor.source_page }}</div>
            </td>
            <td>
                <div class="text-muted">{{ visitor.source_type }}</div>
            </td>
            <td>
                <div class="text-muted">{{ visitor.city }} ({{ visitor.countryCode }})</div>
            </td>
            <td>
                <div class="media-left"
                     v-if="(visitor.user_id > 0 && visitor.uid > 0 && visitor.uid != visitor.user_id)">
                    <a href="javascript:void(0);" class="sidebar-user-box text-semibold txt_red bbotr"
                       :user_id="visitor.user_id" style="padding:0px;">chat</a>
                </div>
                <div class="media-left">
                    <div class="tdropdown ml10">
                        <a class="table_more dropdown-toggle"
                           data-toggle="dropdown"
                           aria-expanded="false"><img
                            src="/assets/images/more.svg"></a>
                        <ul class="dropdown-menu dropdown-menu-right more_act">
                            <a href="#" class="dropdown_close">X</a>
                            <li>
                                <a href="/admin/live/details/{visitor.id}"><i
                                    class="icon-eye"></i> Details</a></li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>

</template>

<script>
    import UserAvatar from '../../helpers/UserAvatar';
    import PlatformImage from '../../helpers/PlatformImage';
    import BrowserImage from '../../helpers/BrowserImage';

    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        name: 'live-visitors',
        data() {
            return {
                visitors: {}
            }
        },
        components: {UserAvatar, PlatformImage, BrowserImage},

        mounted() {
            console.log('Component mounted.');
            axios.get('/admin/live', {_token: tkn})
                .then(response => {
                    this.visitors = response.data;

                    var tableId = 'liveVisitors';
                    this.paginate(tableId);

                });


        },
        methods: {
            displayTimeAgo: function (str) {
                return null;
            },
            loadMorrisGraph: function () {

            }
        },
    };

</script>

<style>
    .outer_circle {
        padding: 14px;
        background: #fff;
        border: 1.5px solid #eee;
        margin: 0 auto !important;
        border-radius: 100%;
        width: 200px;
        height: 200px;
    }

    #bluecircle {
        margin: 0 auto !important;
        float: none !important;
        cursor: pointer;
    }

    path[stroke-width="0.5"] {
        stroke: #eeeeee !important;
        opacity: 0;
    }

    #myfirstchart { /*background: url(images/graphbkg.png) left top repeat!important;*/
    }

    .min_h310 {
        min-height: 300px;
    }

    .highcharts-tick {
        stroke: none !important
    }

    .highcharts-credits {
        display: none !important;
    }

    .highcharts-container, .highcharts-container svg {
        width: 100% !important;
    }

    .highcharts-yaxis-labels {
        display: none !important;
    }

    #canvas2 {
        height: 200px !important;
        padding: 0 25px !important;
    }

    .highcharts-grid, .highcharts-axis-line {
        display: none;
    }


    .mapael .mapTooltip {
        position: absolute;
        background-color: #1e70d8;
        opacity: 0.70;
        border-radius: 5px;
        padding: 10px;
        z-index: 1000;
        max-width: 200px;
        display: none;
        color: #fff;
        top: 20px !important;
    }

    .mapael .map {
        margin-top: 0px;
        height: 230px !important
    }

    .plotLegend {
        position: absolute;
        top: -50px;
        right: 10px;
        padding: 0 10px;
    }

    circle {
        opacity: 0.8
    }


    .pie, .c100 .bar, .c100.p51 .fill, .c100.p52 .fill, .c100.p53 .fill, .c100.p54 .fill, .c100.p55 .fill, .c100.p56 .fill, .c100.p57 .fill, .c100.p58 .fill, .c100.p59 .fill, .c100.p60 .fill, .c100.p61 .fill, .c100.p62 .fill, .c100.p63 .fill, .c100.p64 .fill, .c100.p65 .fill, .c100.p66 .fill, .c100.p67 .fill, .c100.p68 .fill, .c100.p69 .fill, .c100.p70 .fill, .c100.p71 .fill, .c100.p72 .fill, .c100.p73 .fill, .c100.p74 .fill, .c100.p75 .fill, .c100.p76 .fill, .c100.p77 .fill, .c100.p78 .fill, .c100.p79 .fill, .c100.p80 .fill, .c100.p81 .fill, .c100.p82 .fill, .c100.p83 .fill, .c100.p84 .fill, .c100.p85 .fill, .c100.p86 .fill, .c100.p87 .fill, .c100.p88 .fill, .c100.p89 .fill, .c100.p90 .fill, .c100.p91 .fill, .c100.p92 .fill, .c100.p93 .fill, .c100.p94 .fill, .c100.p95 .fill, .c100.p96 .fill, .c100.p97 .fill, .c100.p98 .fill, .c100.p99 .fill, .c100.p100 .fill {
        border: 0.08em solid #eb4f76;
    }

    .c100:hover > span {
        color: #eb4f76;
    }
</style>


