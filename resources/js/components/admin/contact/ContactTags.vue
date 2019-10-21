<template>
    <div>
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
    </div>
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
