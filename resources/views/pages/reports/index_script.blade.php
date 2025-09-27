<script>
    /**
     * Handle on change report title
     */
    const onChangeReportTitle = (event) => {
        const { value } = event.target;

        const baseUrl = window.location.origin + window.location.pathname;
        window.location.replace(`${baseUrl}?type=${value}`);
    };
</script>