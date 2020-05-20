<template>

    <workflow-subscribers></workflow-subscribers>

</template>
<script>
    import WorkflowSubscribers from '@/components/admin/workflow/WorkflowSubscribersNew';

    export default {
        props: ['pageColor'],
        components: {'workflow-subscribers': WorkflowSubscribers},
        data() {
            return {

                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: ''
            }
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
        }
    };


</script>
