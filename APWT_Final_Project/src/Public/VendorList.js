import axios from 'axios';
import { useState, useEffect } from 'react';

const VendorList = () => {
    const [student, setStudent] = useState({});

    useEffect(() => {
        axios.get("http://localhost:8000/api/users/user").then(
            (res) => {
                setStudent(res.data);
                console.log(res.data);
                debugger;
            },
            (error) => {
                debugger;
            }

        );
    },[]);

    return (
        <>
            <table>
                {/* <tr>
                    <td>
                        <button onClick={ClickCheck}>Load Details</button>
                    </td>
                </tr> */}
                <tr>
                    <th>Student Name:</th>
                    <td>{student.name}</td>
                </tr>
                <tr>
                    <th>Student ID:</th>
                    <td>{student.Id}</td>
                </tr>
                <tr>
                    <th>Student DOB:</th>
                    <td>{student.Dob}</td>
                </tr>
                <tr>
                    <th>Student CGPA:</th>
                    <td>{student.Cgpa}</td>
                </tr>
            </table>
        </>
    )
}

export default VendorList;