function timeClock() {
    Swal.mixin({
        input: 'text',
        confirmButtonText: 'Next &rarr;',
        showCancelButton: true,
        progressSteps: ['1', '2']
    }).queue([
        {
            title: 'Employee Time Clock',
            text: 'Scan your ID badge.'
        },
        'Clock In or Out',
    ]).then((result) => {
        if (result.value) {
            const answers = JSON.stringify(result.value)
            Swal.fire({
                title: 'All done!',
                html: `                                   
            Your answers:                           
            <pre><code>${answers}</code></pre>      
          `,
                confirmButtonText: 'Lovely!'
            })
        }
    })
}