<template>
    <button class="btn" v-on:click="build" :disabled="isBuilding">{{ message }}</button>
</template>
<script>
    module.exports = {
        data: () => {
            return {
                message: "Build!",
                isBuilding: false
            }
        },
        props: ['projectId'],
        methods: {
            build: () => {
                this.message = "... Building!";
                this.isBuilding = true;
                console.log(this.message);

                // axios.post(`projects/${id}/build`)
                //     .then(function (response) {
                //         this.isBuilding = true;
                //         this.message = "Build!";
                //         console.log(response);
                //     });
            }
        }
    }
</script>