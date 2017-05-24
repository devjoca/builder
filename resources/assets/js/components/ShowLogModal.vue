<template>
    <button class="btn" @click="openModal" >Show Log</button>
</template>

<script>
export default {
    props: ['output'],
    methods: {
        openModal() {
            $('#logModal').modal();
            $('#logBody').html(this.output);
        }
    }
}
</script>