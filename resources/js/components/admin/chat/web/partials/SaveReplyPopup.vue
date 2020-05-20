<template>
    <div class="box" style="width: 424px;">


        <div style="width: 424px;overflow: hidden; height: 100%;">
            <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"><a class="cross_icon saveReplyBox"><i
                class=""><img src="assets/images/cross.svg"/></i></a>
                <div class="p40">
                    <div class="row">
                        <div class="col-md-12"><img src="assets/images/saved_reply_forum.svg"/>
                            <h3 class="htxt_medium_24 dark_800 mt20">Create Saved Reply </h3>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <form action="/action_page.php">
                                <div class="form-group">
                                    <label class="fsize11" for="replyTitle">REPLY NAME</label>
                                    <input type="text" class="form-control h56 fsize13" v-model="replyTitle" @keypress="clearAlerts"
                                           placeholder="Name (Internal only)" id="replyTitle">
                                </div>
                                <div class="form-group">
                                    <label class="fsize11" for="replyDesc">REPLY CONTENT</label>
                                    <textarea class="form-control min_h_185 p20 pt10 fsize13" v-model="replyDesc"
                                              placeholder="Reply content goes here..." id="replyDesc" @keypress="clearAlerts"></textarea>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row bottom-position">
                        <div class="col-md-12 mb15">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600"
                                    @click.prevent="saveReplyTemplate">Save Reply
                            </button>
                            <a class="blue_300 fsize16 fw600 ml20 saveReplyBox" href="javascript:void(0);">Close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                refreshMessage: 1,


                loading: false,
                replyTitle: '',
                replyDesc: ''
            }
        },
        methods: {
            saveReplyTemplate: function () {
                if (this.replyTitle && this.replyDesc) {
                    this.showLoading(true);
                    axios.post('/admin/chatshortcut/addShortCut', {
                        shortname: this.replyTitle,
                        conversatation: this.replyDesc,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if (response.data.status == 'success') {
                                this.$emit('updateShortcuts');
                                this.displayMessage('success', 'Reply shortcut saved successfully!');
                                this.showLoading(false);
                                this.resetForm();
                            }
                        });
                }else{
                    this.errorMsg = "All fields are mandatory";
                }

            },
            resetForm: function () {
                this.shortname = '';
                this.conversatation = '';
            },
            clearAlerts: function(){

            }

        }
    };
</script>
