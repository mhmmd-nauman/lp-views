Hello {agent_full_name}!
<br/><br/>
<p>You have received a new appointment request from {customer_full_name}</p>
<h4>Customer Information</h4>
<ul>
	<li>
		<span>Full Name:</span> <strong>{customer_full_name}</strong>
	</li>
	<li>
		<span>Email Address:</span> <strong>{customer_email}</strong>
	</li>
	<li>
		<span>Phone:</span> <strong>{customer_phone}</strong>
	</li>
	<li>
		<span>Comments:</span> <strong>{customer_notes}</strong>
	</li>
</ul>
<h4>Appointment Information</h4>
<ul>
	<li>
		<span>Service:</span> <strong>{service_name}</strong>
	</li>
	<li>
		<span>Date, Time:</span> <strong>{start_date}, {start_time} - {end_time}</strong>
	</li>
        <li>
		<span>Live Call:</span> <strong><a target="_blank" href="{room_text}" >{room_text}</a></strong>
	</li>
</ul>