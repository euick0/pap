'use client';

import React from 'react';
import SidebarItem from "@/app/main/sidebarItem";
import clsx from "clsx";

const Sidebar = () => {
    const [isExpanded, setIsExpanded] = React.useState(false);

    return (
        <div
            className={clsx("group bg-backgroundLight w-20 h-full absolute top-0 left-0 rounded-r-lg z-10 transition-all duration-300 ease-in-out flex flex-col justify-between",{
                "w-64": isExpanded,
            })}>
            <div className="h-20 w-1 absolute bg-white top-0 left-0">

            </div>
            <div className="w-full flex-row items-center">
                <div
                    onClick={() => {
                        setIsExpanded(!isExpanded)
                    }}>
                    <SidebarItem size={45} text="Toggle Sidebar" imagePath="svgs/sidebar.svg" invert={true}/>
                </div>
                <SidebarItem size={70} text="Main Page" imagePath="svgs/Reqal Logo - Dark Mode.svg"/>
            </div>
            <div className="w-full flex-row items-center">
                <SidebarItem size={70} text="Main Page" imagePath="svgs/Reqal Logo - Dark Mode.svg"/>
            </div>
        </div>
    );
};

export default Sidebar;
