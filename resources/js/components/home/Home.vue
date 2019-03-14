<template>
    <div class="content">
        <div class="title m-b-md">
            Laravel
        </div>
        <div class="links">
            <a :href="''">Docs</a>
            <a :href="''">Laracasts</a>
            <a :href="''">News</a>
            <a :href="''">Blog</a>
            <a :href="''">Nova</a>
            <a :href="''">Forge</a>
            <a :href="''">GitHub</a>
        </div>
    </div>
</template>
<script>
export default {
    mounted(){
        console.log(this.$router.history.current.name);
    }
}
</script>

