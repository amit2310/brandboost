<template>

    <div class="content" id="masterContainer">
        Content goes here.
    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    export default {
        title: 'User Profile - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {
            }
        },
        mounted() {
            console.log('Component mounted');
        }
    }

    $(document).ready(function () {

    });

</script>
