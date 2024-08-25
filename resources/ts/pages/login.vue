<script lang="ts" setup>
import { router, usePage } from "@inertiajs/vue3";
import { telegramService } from "../services";

const page = usePage();
router.post(page.props.auth.route, {
    init_data: telegramService.getInitData(),
});
</script>

<template>
    <section class="h-screen w-screen flex items-center justify-center">
        <h1
            v-if="page.props.errors.init_data === undefined"
            class="text-3xl font-medium"
        >
            Выполняется вход...
        </h1>
        <h1
            v-if="page.props.errors.init_data !== undefined"
            class="text-3xl font-medium"
        >
            {{ page.props.errors.init_data }}
        </h1>
    </section>
</template>
