<template>
    <div>
        <smart-workflow :moduleName="moduleName" :moduleUnitId="moduleUnitID"></smart-workflow>
    </div>
</template>
<script>
    import SmartWorkflow from '@/components/admin/smart-workflow/SmartWorkflow';
    export default {
        components: {SmartWorkflow},
        data() {
            return {
                moduleName: 'brandboost',
                moduleUnitID: this.$route.params.id,
            }
        },
        created: function () {
            this.makeBreadcrumb({
                Home: '#/',
                Reviews: '#/reviews/dashboard',
                Workflows: '#/reviews/onsite/workflow',
                Setup: ''
            });
        }
    };
</script>

