<script>
    // Batas inaktivitas (5 menit = 5 * 60 * 1000 milidetik)
    const WAKTU_TUNGGU = 5 * 60 * 1000; 
    let timerInaktif;

    function lakukanLogoutOtomatis() {
        alert('Sesi Anda telah berakhir karena tidak ada aktivitas. Silakan masuk kembali.');
        
        const formLogout = document.getElementById('global-logout-form') || document.querySelector('form[action*="logout"]');
        if (formLogout) {
            formLogout.submit();
        } else {
            window.location.href = "{{ route('logout') }}"; 
        }
    }

    function resetTimerAktivitas() {
        clearTimeout(timerInaktif);
        timerInaktif = setTimeout(lakukanLogoutOtomatis, WAKTU_TUNGGU);
    }

    // Daftarkan semua interaksi user
    window.onload = resetTimerAktivitas;
    window.onmousemove = resetTimerAktivitas;
    window.onmousedown = resetTimerAktivitas;
    window.ontouchstart = resetTimerAktivitas;
    window.onclick = resetTimerAktivitas;
    window.onkeydown = resetTimerAktivitas;
    window.addEventListener('scroll', resetTimerAktivitas, true);
</script>