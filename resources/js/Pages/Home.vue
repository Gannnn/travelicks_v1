
<template>
    <body class="antialiased">
        <div class="parallax-image parallax-image-01"></div>
        <div class="parallax-image parallax-image-02"></div>
        <div class="parallax-image parallax-image-03"></div>

        <Layout title="Home Page">

            <NoResults v-if="props.listings.data && props.listings.data.length <= 0" />
    
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-8">
                <Listing v-for="listing in props.listings.data" :key="listing.id" v-bind="listing" />
            </div>
    
        </Layout>
    </body>

</template>

<script setup>
    import { defineProps } from 'vue';

    import Layout from '@/Layouts/Layout.vue';
    import Listing from '@/Components/listing/Listing.vue';
    import NoResults from '@/Components/listing/NoResults.vue';

    const props = defineProps({
        listings: {
            type: Object,
            required: false,
            default: []
        }
    });
</script>

<style scoped>

.parallax-image {
    height: 58.75rem;
    width: 100%;
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
}

.parallax-image-01 {
    background-image: url("assets/autumn_forest.jpg");
}

.parallax-image-02 {
    background-image: url("assets/forest_pathway.jpg");
}

.parallax-image-03 {
    background-image: url("assets/winter_forest.jpg");
}

section {
    padding: 4rem;
}

section > h2 {
    text-transform: uppercase;
    margin-bottom: 1.5rem;
}

</style>
