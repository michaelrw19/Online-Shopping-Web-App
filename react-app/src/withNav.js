import React from 'react';
import Navigation from './components/Navigation'
import { Outlet } from 'react-router';

export default () => {
    return (
        <>
            <Navigation />
            <Outlet />
        </>
    );
};