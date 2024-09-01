import { useState } from 'react';
import axios from 'axios';
import styles from '../css/styles.module.css';
import Users from '../Users';

const Main = () => {
  const [users, setUsers] = useState([]);
  const [userDetails, setUserDetails] = useState(null);
  const [view, setView] = useState('');

  const handleLogout = () => {
    localStorage.removeItem('token');
    window.location.reload();
  };

  const handleGetUsers = async (e) => {
    e.preventDefault();
    const token = localStorage.getItem('token');
    if (token) {
      try {
        const config = {
          method: 'get',
          url: 'http://localhost:8080/api/users',
          headers: { 'Content-Type': 'application/json', 'x-access-token': token },
        };
        const { data: res } = await axios(config);
        setUsers(res.data);
        setUserDetails(null);
        setView('users');
      } catch (error) {
        if (error.response && error.response.status >= 400 && error.response.status <= 500) {
          localStorage.removeItem('token');
          window.location.reload();
        }
      }
    }
  };

  const handleGetUserDetails = async (e) => {
    e.preventDefault();
    const token = localStorage.getItem('token');
    if (token) {
      try {
        const config = {
          method: 'get',
          url: 'http://localhost:8080/api/users/me',
          headers: { 'Content-Type': 'application/json', 'x-access-token': token },
        };
        const { data: res } = await axios(config);
        setUserDetails(res);
        setUsers([]);
        setView('account');
      } catch (error) {
        if (error.response && error.response.status >= 400 && error.response.status <= 500) {
          localStorage.removeItem('token');
          window.location.reload();
        }
      }
    }
  };

  const handleDeleteAccount = async (e) => {
    e.preventDefault();
    const confirmDelete = window.confirm('Are you sure you want to delete your account?');
    if (confirmDelete) {
      const token = localStorage.getItem('token');
      if (token) {
        try {
          const config = {
            method: 'delete',
            url: 'http://localhost:8080/api/users/me',
            headers: { 'Content-Type': 'application/json', 'x-access-token': token },
          };
          await axios(config);
          localStorage.removeItem('token');
          window.location.reload();
        } catch (error) {
          if (error.response && error.response.status >= 400 && error.response.status <= 500) {
            localStorage.removeItem('token');
            window.location.reload();
          }
        }
      }
    }
  };

  return (
    <div className={styles.main_container}>
      <nav className={styles.navbar}>
        <h1>MySite</h1>
        <button className={styles.white_btn} onClick={handleLogout}>
          Logout
        </button>
        <button className={styles.white_btn} onClick={handleGetUsers}>
          Users
        </button>
        <button className={styles.white_btn} onClick={handleGetUserDetails}>
          My Account
        </button>
        <button className={styles.white_btn} onClick={handleDeleteAccount}>
          Delete Account
        </button>
      </nav>
      {view === 'users' && users.length > 0 ? <Users users={users} /> : null}
      {view === 'account' && userDetails ? (
        <div>
          <h2>My Account</h2>
          <p>First Name: {userDetails.firstName}</p>
          <p>Last Name: {userDetails.lastName}</p>
          <p>Email: {userDetails.email}</p>
        </div>
      ) : null}
    </div>
  );
};

export default Main;
