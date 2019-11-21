<template>
    <workflow-grid :workflowData="workflowData" v-bind="workflowData"></workflow-grid>
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
            }
        },
        beforeRouteLeave(to, from, next){
            this.removeWorkflowStyle();
            next();
        },
    }
</script>





