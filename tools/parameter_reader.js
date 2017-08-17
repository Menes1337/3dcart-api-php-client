var parameterList = [];
var parameterTypeList = [];

$('.parameter-name').each(function (index) {
    parameterList.push($(this).html());
})

$('.parameter-type').each(function (index) {
    parameterTypeList.push($(this).html());
})

function walkthrough(printFunction) {
    var i = 0;
    for (i = 0; i < parameterList.length; ++i) {
        var parameterType = '';
        switch (parameterTypeList[i].trim()) {
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
            case "date":
                parameterType = 'string';
                break;
            default:
                parameterType = parameterTypeList[i].trim();
                break;
        }

        printFunction("public", parameterList[i], parameterType);
    }
}

walkthrough(printResourceMemberVariable)
walkthrough(printFilterFunctionPerParameter)
walkthrough(printConstants)

document.write("<br /><br />")
printAllConstantsInLine();
document.write("<br /><br />")
walkthrough(printFilterConstants)
document.write("<br /><br />")
printAllFilterConstantsInLine();

function printResourceMemberVariable(visibility, parameterName, parameterType) {
    document.write("/** @var ");
    document.write(parameterType);
    document.write(" */")
    document.write("<br/ >")
    document.write(visibility + " $" + parameterName + ";");
    document.write("<br /><br />")
}

function printFilterFunctionPerParameter(visibility, parameterName, parameterType) {
    document.write("/**");
    document.write("<br/ >")
    document.write(" * @param ")

    parameterTypeName = '';
    switch (parameterType) {
        case "string":
            parameterTypeName = "StringValueObject";
            break;
        case "int":
            parameterTypeName = "IntegerValueObject";
            break;
        case "bool":
            parameterTypeName = "BooleanValueObject";
            break;
        case "float":
            parameterTypeName = "FloatValueObject";
            break;
        default:
            break;
    }

    document.write(parameterTypeName + " ");

    document.write("$" + parameterName)
    document.write("<br/ >")
    document.write(" */");
    document.write("<br/ >")
    document.write("public function filter" + parameterName.charAt(0).toUpperCase() + parameterName.slice(1) + "(" + parameterTypeName + " $" + parameterName + ");")
    document.write("<br/ ><br />")
}

function printConstants(visibility, parameterName, parameterType) {
    document.write('const ' + parameterName.toUpperCase() + " = \"" + parameterName + "\";")
    document.write("<br />")
}

function printAllConstantsInLine() {
    toUpper = function (x) {
        return x.toUpperCase();
    };

    document.write("public static $allowedValues = [self::" + parameterList.map(toUpper).join(", self::") + "];");
}

function printFilterConstants(visibility, parameterName, parameterType) {
    document.write('const FILTER_' + parameterName.toUpperCase() + " = \"" + parameterName + "\";")
    document.write("<br />")
}

function printAllFilterConstantsInLine() {
    toUpper = function (x) {
        return x.toUpperCase();
    };

    document.write("public static $allowedValues = [self::FILTER_" + parameterList.map(toUpper).join(", self::FILTER_") + "];");
}
