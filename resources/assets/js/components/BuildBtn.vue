<template>
    <button class="btn" @click="build(projectId)" :disabled="isBuilding">{{ message }}</button>
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
            build(projectId) {
                const vm = this;
                vm.message = "... Building!";
                vm.isBuilding = true;

                axios.post(`projects/${projectId}/build`)
                    .then(function (response) {
                        vm.isBuilding = false;
                        vm.message = "Build!";
                    });
            }
        }
    }
</script>