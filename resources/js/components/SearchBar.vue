<template>
    <div class="input-group home-search-input">
        <input
            class="form-control"
            placeholder="Search"
            type="text"
            v-model="searchText"
            @keyup.enter="fetchResults"
        />

        <div class="input-group-append">
            <button
                class="btn btn-primary"
                type="button"
                @click.prevent="fetchResults"
            >
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        searchText: null,
    }),

    methods: {
        fetchResults() {
            axios
                .get("/api/products", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => {
                    this.$router.replace({
                        name: "results",
                        params: {
                            searchText: this.searchText,
                            results: data.data,
                        },
                    });
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {},
};
</script>
