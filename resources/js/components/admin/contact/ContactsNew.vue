<template>
    <workflow-subscribers></workflow-subscribers>

</template>
<script>
    import WorkflowSubscribers from '@/components/admin/workflow/WorkflowSubscribersNew.vue';

    export default {
        props: ['pageColor'],
        components: {'workflow-subscribers': WorkflowSubscribers},
        data() {
            return {
                loading: true,
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
