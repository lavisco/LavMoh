<template>
    <div class="header bg-blue pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-4 col-7">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"
                                    ><i class="ni ni-zoom-split-in"></i
                                ></span>
                            </div>
                            <input
                                class="form-control form-control-alternative"
                                placeholder="Search"
                                type="text"
                                :value="value"
                                @input="$emit('input', $event.target.value)"
                            />
                        </div>
                    </div>
                    <div class="col-lg-8 col-5 text-right">
                        <button
                            class="btn btn-neutral"
                            type="button"
                            @click="$emit('callNewModal')"
                        >
                            <i class="fas fa-plus-circle mr-2"></i>
                            New
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["value"],
    mounted() {},
};
</script>
