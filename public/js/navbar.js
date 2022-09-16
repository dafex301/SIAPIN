const profile = document.getElementById('profile');

// If click profile, toggle profile popup
profile.addEventListener('click', () => {
	// Remove hidden class from profile popup
	document.getElementById('profile-popup').classList.toggle('hidden');
});

// If cursor leave profile popup, hide profile popup
document.getElementById('profile-popup').addEventListener('mouseleave', () => {
	// Add hidden class to profile popup
	document.getElementById('profile-popup').classList.add('hidden');
});
