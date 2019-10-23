<template>
    <span v-if="tagCounts>2">
        <template v-if="(tags[0].tag_name.length + tags[1].tag_name.length)>16">
            # {{tags[0].tag_name}} <span style="margin-left:15px;cursor:pointer;" class="badge badge-dark" data-toggle="dropdown"
                                         aria-expanded="false">+.{{tagCounts-1}}</span>
            <ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right tagss">
                    <button v-for="tag in tags" class="btn btn-xs btn_white_table pr10" v-text="tag.tag_name"></button>
                    <button class="btn btn-xs plus_icon ml10 applyInsightTags" :data-subscriber-id="subscriber_id">
                        <i class="icon-plus3"></i>
                    </button>
            </ul>
        </template>
        <template v-else>
            # {{tags[0].tag_name}},  {{tags[1].tag_name}}<span style="margin-left:15px;cursor:pointer;" class="badge badge-dark"
                                                               data-toggle="dropdown" aria-expanded="false">+.{{tagCounts-2}}</span>
            <ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right tagss">
                    <button v-for="tag in tags" class="btn btn-xs btn_white_table pr10" v-text="tag.tag_name"></button>
                    <button class="btn btn-xs plus_icon ml10 applyInsightTags" :data-subscriber-id="subscriber_id">
                        <i class="icon-plus3"></i>
                    </button>
            </ul>
        </template>
    </span>

    <span v-else-if="tagCounts == 2">
        <template v-if="(tags[0].tag_name.length + tags[1].tag_name.length)>16">
            # {{tags[0].tag_name}} <span style="margin-left:15px;cursor:pointer;" class="badge badge-dark" data-toggle="dropdown"
                                         aria-expanded="false">+1</span>
            <ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right tagss">
                    <button v-for="tag in tags" class="btn btn-xs btn_white_table pr10" v-text="tag.tag_name"></button>
                    <button class="btn btn-xs plus_icon ml10 applyInsightTags" :data-subscriber-id="subscriber_id">
                        <i class="icon-plus3"></i>
                    </button>
            </ul>
        </template>
        <template v-else>
            # {{tags[0].tag_name}},  {{tags[1].tag_name}}
        </template>
    </span>

    <span v-else-if="tagCounts == 1">
        # {{tags[0].tag_name}}
    </span>

    <span v-else v-html="displayNoData()"></span>

    <!--<div>
        <div class="media-left pl30 blef">
            <div class="">
                <a href="javascript:void(0);" class="text-default text-semibold bbot">
                    {{ tagCounts }} Tags
                </a>
            </div>
        </div>
        <div class="media-left pr30 brig">
            <div class="tdropdown">
                <button class="btn btn-xs plus_icon dropdown-toggle ml10" data-toggle="dropdown" aria-expanded="false">
                    <i class="icon-plus3"></i>
                </button>
                <ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right tagss">
                    <button v-for="tag in tags" class="btn btn-xs btn_white_table pr10" v-text="tag.tag_name"></button>
                    <button class="btn btn-xs plus_icon ml10 applyInsightTags" :data-subscriber-id="subscriber_id">
                        <i class="icon-plus3"></i>
                    </button>
                </ul>
            </div>
        </div>
    </div>-->
</template>

<script>
    let tkn = $('meta[name="_token"]').attr('content');
    export default {
        name: 'contact-tags',
        props: ['subscriber_id'],
        data() {
            return {
                tags: {},
                tagCounts: 0,

            }
        },
        mounted() {
            axios.post('/admin/helperutility/getSubscriberTags', {_token: tkn, subscriber_id: this.subscriber_id})
                .then(response => {
                    this.tags = response.data.oTags;
                    this.tagCounts = response.data.tagCount;

                });
        },
        methods: {},
    };

</script>
