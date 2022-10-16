<template>
    <div
        class="
            hide-content-md-flex
            d-flex
            justify-content-center
            align-items-center
            category-link-box
        "
    >
        <a
            class="category-link"
            v-for="category in categories"
            :key="category.id"
            :href="`/categories/${category.id}/${locationActive}/${category.slug}`"
        >
            {{ category.name }}
        </a>
    </div>
</template>

<script>
export default {
    data: () => ({
        categories: [],
    }),

    computed: {
        locationActive() {
            return this.$store.getters.selectedLocation;
        },
    },

    methods: {
        loadData() {
            axios
                .get("/api/navdata")
                .then((response) => {
                    this.categories = response.data.categories;
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadData();
        Fire.$on("reloadRecords", () => {
            this.loadData();
        });
    },
};
</script>
