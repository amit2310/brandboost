<template>
    <workflow-grid :workflowData="workflowData" v-bind="workflowData" @realoadTree="refreshTree"></workflow-grid>
</template>
<script>
    import workflowGrid from '../../workflow/MasterWorkflow';
    export default {
        components : {workflowGrid},
        data(){
            return {
                automationId: this.$route.params.id,
                workflowData: ''

            }
        },
        mounted() {
            document.querySelector("body").id="SMSSection";
            this.applyWorkflowStyle();
            this.getWorkflowData();
        },
        methods: {
            getWorkflowData: function(){
                axios.get('/admin/modules/emails/setupAutomation/' + this.automationId)
                    .then(response => {
                        this.workflowData = response.data;
                    });
            },
            applyWorkflowStyle: function(){
                document.querySelector(".navbar-custom").style = "background: #ffffff!important; padding-left: 320px";
            },
            removeWorkflowStyle: function(){
                document.querySelector(".navbar-custom").style = "";
            },
            refreshTree: function(){
                this.getWorkflowData();
            }
        },
        beforeRouteLeave(to, from, next){
            this.removeWorkflowStyle();
            next();
        }

    }
</script>





