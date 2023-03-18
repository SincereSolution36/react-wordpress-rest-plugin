import React, { useEffect, useState } from 'react'
import { LineChart, Line, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from 'recharts';

const Dashboard = () => {
	const [value, setValue] = useState(7);
	const [data, setData] = useState([]);

	function durationChangeHandler(e) {
		setValue(e.target.value);
	}

	useEffect(() => {
		async function loadData() {
            const response = await fetch(`http://localhost/wordpress/wp-json/v1/chart/${value}`);
            if(!response.ok) {
                // oups! something went wrong
                return;
            }
    
            const posts = await response.json();
			console.log(posts);
            setData(JSON.parse(posts));
        }
    
        loadData();
	}, [value]);

    return (
        <>
			<div className="charts-top">
				<h2>Graph Widget</h2>

				<p>
					<select name="period" onChange={ durationChangeHandler }>
						<option value="7" selected={value === 7 ? 'selected' : ''}>Last 7 Days</option>
						<option value="15" selected={value === 15 ? 'selected' : ''}>Last 15 Days</option>
						<option value="1" selected={value === 1 ? 'selected' : ''}>Last 1 month</option>
					</select>
				</p>
			</div>

			<LineChart
				width={500}
				height={300}
				data={data}
				margin={{
					top: 5,
					right: 30,
					left: 20,
					bottom: 5,
				}}
			>
				<CartesianGrid strokeDasharray="3 3" />
				<XAxis dataKey="name" />
				<YAxis />
				<Tooltip />
				<Legend />
				<Line type="monotone" dataKey="pv" stroke="#8884d8" activeDot={{ r: 8 }} />
			</LineChart>
        </>
     );
}

export default Dashboard;