import {ComponentPreview, Previews} from "@react-buddy/ide-toolbox-next";
import {PaletteTree} from "./palette";
import Button from "@/component/button";
import Logo from "@/component/logo";

const ComponentPreviews = () => {
    return (
        <Previews palette={<PaletteTree/>}>
            <ComponentPreview path="/Button">
                <Button/>
            </ComponentPreview>
            <ComponentPreview path="/Logo">
                <Logo width={75} height={75}/>
            </ComponentPreview>
        </Previews>
    );
};

export default ComponentPreviews;