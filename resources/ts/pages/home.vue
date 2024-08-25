<script lang="ts" setup>
import { usePage } from "@inertiajs/vue3";
import UserData = App.DTO.User.UserData;

const page = usePage<{
    auth: {
        user: UserData;
    };
}>();
</script>

<template>
    <h1 class="text-3xl">Hello, {{ page.props.auth.user.username }}!</h1>
</template>
