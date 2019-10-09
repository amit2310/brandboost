<template>

    <div class="content" id="masterContainer">

        <div class="content">
            Tags Reviews
        </div>

    </div>

</template>

<script>

    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        title: 'Tags Reviews - Brand Boost',
        data() {
            return {
                oTags: {},
                oGroupIDs : {}
            }
        },

        mounted() {
            // //getData
            // axios.get('/admin/tags/')
            //     .then(response => {
            //         //console.log(response.data);
            //
            //         this.oTags = response.data.aTag;
            //         this.oGroupIDs = response.data.aGroupID;
            //         console.log(this.oTags);
            //         console.log(this.oGroupIDs);
            //     });

            console.log('Component mounted.');
        }

    }
</script>

