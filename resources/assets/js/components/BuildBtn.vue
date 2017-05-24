<template>
    <button class="btn" @click="build()" :disabled="isBuilding">{{ message }}</button>
</template>
<script>
    export default {
        data() {
            return {
                message: "Build!",
                isBuilding: false
            }
        },
        props: ['projectId'],
        methods: {
            build() {
                const vm = this;
                vm.message = "... Building!";
                vm.isBuilding = true;

                axios.post(`projects/${this.projectId}/build`)
                    .then(function (response) {
                        vm.isBuilding = false;
                        vm.message = "Build!";
                    });
            }
        }
    }
</script>