var parameterList = [];
var parameterTypeList = [];

$('.parameter-name').each(function (index) {
    parameterList.push($(this).html());
})

$('.parameter-type').each(function (index) {
    parameterTypeList.push($(this).html());
})

for (var i = 0; i < parameterList.length; ++i) {
    console.log(parameterTypeList[i]);

    var parameterType = '';
    switch(parameterTypeList[i].trim()) {
        case "integer":
            parameterType = 'int';
            break;
        case "string":
            parameterType = 'string';
            break;
        case "decimal number":
            parameterType = 'float';
            break;
        case "boolean":
            parameterType = 'bool';
            break;
        default:
            parameterType = 'lol';
            break;
    }

    printMemberVariable("private", parameterList[i], parameterType);

    //printConstants(parameterList[i])
}

document.write("<br /><br />")
printAllConstantsInLine();

function printMemberVariable(visibility, parameterName, parameterType) {
    document.write("/** @var ");
    document.write(parameterType);
    document.write(" */")
    document.write("<br/ >")
    document.write(visibility + " $" + parameterName +";");
    document.write("<br /><br />")
}

function printConstants(parameterName) {
    document.write('const '+ parameterName.toUpperCase() +" = \""+ parameterName +"\";")
    document.write("<br />")
}

function printAllConstantsInLine() {
    toUpper = function(x){
        return x.toUpperCase();
    };

    document.write("public static $allowedValues = [self::" + parameterList.map(toUpper).join(", self::") + "];");
}
