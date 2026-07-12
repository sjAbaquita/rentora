<script setup lang="ts">
	defineProps<{
		border?: boolean
	}>()
</script>

<template>
	<section
		:class="[
			'flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between',
			border ? 'border-b' : '',
		]"
	>
		<!-- LEFT CONTENT -->
		<div>
			<slot />
		</div>

		<!-- RIGHT ACTIONS -->
		<div class="flex items-center gap-2">
			<slot name="actions" />
		</div>
	</section>
</template>